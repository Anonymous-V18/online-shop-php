# _**Website bán đủ thứ trên đời**_

## Công nghệ sử dụng

-   Theo yêu cầu của giảng viên
-   Sử dụng version mới nhất cho các package

## Cách run project

-   Lần lượt chạy các lệnh dưới đây:
    -   `php artisan storage:link`
    -   `php artisan migrate --seed`
    -   `php artisan optimize:clear`
    -   `php artisan route:clear`
    -   `php artisan config:clear`
    -   `php artisan view:clear`
    -   `php artisan cache:clear`
    -   `composer dump-autoload`
-   Chạy file **vn_addresses_full.sql** có sẵn trong thư mục database.
-   Chạy lệnh sau để chạy project `php artisan serve`

## Các trang cơ bản

-   [Trang home](http://localhost:8000)
-   [Trang admin](http://localhost:8000/admin)
