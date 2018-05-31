<html>
@if(isset($name))
Họ tên: {{ $name }} <br>
@endif

@if(isset($email))
Email: {{ $email }} <br>
@endif

@if(isset($phone))
Phone: {{ $phone }} <br>
@endif

@if(isset($reason))
Vấn đề cần tư vấn: {{ $reason }} <br>
@endif

@if(isset($content))
Nội dung: {{ $content }} <br>
@endif
</html>