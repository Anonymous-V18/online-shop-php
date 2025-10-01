@extends('layouts.app')
@section('title','FAQ')
@section('content')
<h3>Câu hỏi thường gặp</h3>
<div class="accordion" id="faq">
  <div class="accordion-item">
    <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#q1">Thời gian giao hàng?</button></h2>
    <div id="q1" class="accordion-collapse collapse show" data-bs-parent="#faq"><div class="accordion-body">Trong 2-5 ngày làm việc tùy khu vực.</div></div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q2">Chính sách đổi trả?</button></h2>
    <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faq"><div class="accordion-body">Đổi trong 7 ngày nếu lỗi nhà sản xuất.</div></div>
  </div>
</div>
@endsection
