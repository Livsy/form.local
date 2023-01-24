@extends('layouts.frontend')

@section('content')

    <div class="card">
        <div class="card-header">
            Регистрация
        </div>
        <div class="card-body">
            <div class="errors"></div>
            <div class="errors2"></div>
            <form class="sendForm" method="return false">
                @csrf
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="name" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="lastName">Фамилия</label>
                    <input type="name" class="form-control" id="lastName" name="lastName">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Повторите пароль</label>
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <label class="message"></label>
            </form>
        </div>
    </div>
@endsection


@section('js')
    <script src="/js/lib/jquery.mockjax.js"></script>
    <script src="/js/lib/jquery.form.js"></script>
    <script src="/js/dist/jquery.validate.min.js"></script>
    <script src="/js/userForm.js"></script>
@endsection
