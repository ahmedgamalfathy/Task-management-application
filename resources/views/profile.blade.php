@extends('layouts.app')

@section('tilte','الملف الشخصي')

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="text-center">
                {{-- {{asset(auth()->user()->image) }}--}}
                {{-- images/users/person.jpg--}}
                <img src="{{asset('storage/'.auth()->user()->image )}}" alt="" width="82px" height="82px">
                <h3>
                    {{ auth()->user()->name }}
                </h3>
             </div>
             <div class="card-body text-right" dir="rtl">
                 <form action="/profile" method="POST" enctype="multipart/form-data">
                 @csrf
                 @method("PATCH")
                <div class="form-group">
                <label for="name">الاسم</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name}}">
                   @error('name')
                       <div class="text-danger">
                        <small> {{ $message}}</small>   
                       </div>
                   @enderror
            </div>
                <div class="form-group">
                <label for="email">البريد الالكتورني</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" >
                 @error('email')
                 <div class="text-danger">
                    <small> {{$message}}</small>
                </div>
                 @enderror
                </div>  
                <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                <div class="text-danger">
                   <small> {{$message}}</small>
               </div>
                @enderror
                </div>  

                <div class="form-group">
                <label for="password_confirmation">تغير كلمة المرور</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                @error('password_confirmation')
                <div class="text-danger">
                   <small> {{$message}}</small>
               </div>
                @enderror
                </div>      
                <div class="form-group">
                    <label for="image">تغير الصورة الشخصية </label>
                    <div class="custom-file">
                        <input type="file" name="image" id="image" class="custom-file-input">
                        <label for="image" id="image-lable" class="custom-file-lable text-left" data-browse="استعراض"></label>
                        @error('image')
                        <div class="text-danger">
                        <small> {{$message}}</small>
                        </div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group d-flex mt-5 flex-row-reverse">
                    <button type="submit" class="btn btn-primary mr-2">حفظ التعديلات</button>
                    <button type="submit" class="btn btn-light" form="logout">تسجيل الخروج</button>
                </div>
            </form>
            <form action="/logout" id="logout" method="POST">
            @csrf
            </form>
             </div>
             
          </div>
       </div>
    </div>
   {{-- الجزء الخاص بالجافا اسكربت هو المسؤول
    عن عرض الملف في الحقول المطلوب اضافة ملق بداخلة--}}
    <script>
        document.getElementById('image').onchange=uploadOnChange;
        function uploadOnChange(){
            let filename = this.value;
            let lastIndex = filename.lastIndexOf("\\");
            if(lastIndex >=0){
                filename = filename.substring(lastIndex + 1);
            }
            document.getElementById('image-lable').innerHTML = filename;
        }
    </script>
@endsection