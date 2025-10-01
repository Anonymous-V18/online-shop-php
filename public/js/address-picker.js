(function () {
    if (window.AddressPickerUltimateGuardLoaded) {
        if (
            window.AddressPicker &&
            typeof window.AddressPicker.refresh === "function"
        ) {
            try {
                window.AddressPicker.refresh();
            } catch (e) {}
        }
        return;
    }
    window.AddressPickerUltimateGuardLoaded = true;

    const API_BASE = (function () {
        try {
            if (typeof window.APP_API === "string" && window.APP_API.length)
                return window.APP_API.replace(/\/+$/, "");
        } catch (e) {}
        return (location.origin || "") + "/api";
    })();

    function qs(el, s) {
        return el.querySelector(s);
    }
    function opt(v, t) {
        const o = document.createElement("option");
        o.value = v;
        o.textContent = t;
        return o;
    }

    async function fetchJSON(url) {
        const res = await fetch(url, {
            headers: { Accept: "application/json" },
        });
        if (!res.ok) {
            const txt = await res.text().catch(() => "");
            console.error("[AddressPicker]", res.status, url, txt);
            throw new Error("HTTP " + res.status);
        }
        return res.json();
    }

    function getSelectedValue(sel) {
        if (!sel) return "";
        if (sel.value) return sel.value;
        if (sel.dataset && sel.dataset.selected) return sel.dataset.selected;
        return "";
    }

    async function populateDistricts(container, provinceId, initial) {
        const dSel = qs(
            container,
            'select[name$="[district_id]"], select[name="district_id"]'
        );
        const wSel = qs(
            container,
            'select[name$="[ward_id]"], select[name="ward_id"]'
        );
        if (!dSel || !wSel) return;

        const currentDistrict = getSelectedValue(dSel);
        const currentWard = getSelectedValue(wSel);

        dSel.innerHTML = "";
        dSel.append(opt("", "Chọn quận/huyện..."));
        wSel.innerHTML = "";
        wSel.append(opt("", "Chọn phường/xã..."));

        if (!provinceId) return;

        const items = await fetchJSON(
            `${API_BASE}/locations/districts?province_id=${encodeURIComponent(
                provinceId
            )}`
        );
        items.forEach((i) => dSel.append(opt(i.id, i.name)));

        const wantDistrict =
            initial && container.dataset.initialDistrict
                ? container.dataset.initialDistrict
                : currentDistrict || dSel.dataset.selected || "";
        if (wantDistrict) {
            dSel.value = String(wantDistrict);
            if (dSel.value === String(wantDistrict)) {
                await populateWards(container, dSel.value, true, currentWard);
            }
        }
    }

    async function populateWards(
        container,
        districtId,
        initial,
        currentWardFromParent
    ) {
        const wSel = qs(
            container,
            'select[name$="[ward_id]"], select[name="ward_id"]'
        );
        if (!wSel) return;

        const currentWard = currentWardFromParent || getSelectedValue(wSel);

        wSel.innerHTML = "";
        wSel.append(opt("", "Chọn phường/xã..."));
        if (!districtId) return;

        const items = await fetchJSON(
            `${API_BASE}/locations/wards?district_id=${encodeURIComponent(
                districtId
            )}`
        );
        items.forEach((i) => wSel.append(opt(i.id, i.name)));

        const wantWard =
            initial && container.dataset.initialWard
                ? container.dataset.initialWard
                : currentWard || wSel.dataset.selected || "";
        if (wantWard) {
            wSel.value = String(wantWard);
        }
    }

    function bind(container) {
        if (container.dataset.addrBound) return;
        container.dataset.addrBound = "1";

        const pSel = qs(
            container,
            'select[name$="[province_id]"], select[name="province_id"]'
        );
        const dSel = qs(
            container,
            'select[name$="[district_id]"], select[name="district_id"]'
        );
        const wSel = qs(
            container,
            'select[name$="[ward_id]"], select[name="ward_id"]'
        );
        if (!pSel || !dSel || !wSel) return;

        pSel.addEventListener("change", () =>
            populateDistricts(container, pSel.value, false)
        );
        dSel.addEventListener("change", () =>
            populateWards(container, dSel.value, false)
        );

        const hasDistrictOptions = dSel.options && dSel.options.length > 1;
        const hasWardOptions = wSel.options && wSel.options.length > 1;

        const initialProvince =
            pSel.value ||
            container.dataset.initialProvince ||
            pSel.dataset.selected ||
            "";
        if (initialProvince && (!hasDistrictOptions || !dSel.value)) {
            populateDistricts(container, initialProvince, true).catch(
                console.error
            );
        }
        if (
            initialProvince &&
            hasDistrictOptions &&
            dSel.value &&
            (!hasWardOptions || !wSel.value)
        ) {
            populateWards(container, dSel.value, true).catch(console.error);
        }
    }

    function refresh() {
        document.querySelectorAll("[data-address-picker]").forEach(bind);
    }

    if (document.readyState === "loading")
        document.addEventListener("DOMContentLoaded", refresh);
    else refresh();

    window.AddressPicker = Object.assign(window.AddressPicker || {}, {
        refresh,
    });
})();
