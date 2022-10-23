@extends('layouts.app')
@section('content')
<header class="d-flex justify-content-between align-items-center my-5" dir="rtl">
    <div class="h6 text-dark">
        <a href="/projects">المشاريع/ {{ $project->title }}</a>
    </div>
    <div>
        <a href="/projects/{{ $project->id }}/edit" class="btn btn-primary px-4 " role="button">تعديل المشروع </a>
    </div>
</header>
<section class="row text-right" dir="rtl">
    <div class="col-lg-4">
      {{-- Project Details --}}
      <div class="card">
        <div class="card-body">
            <div class="status">
                @switch($project->status)
                   @case(1)
                      <span class="text-success">مكتمل</span>
                    @break
                    @case(2)
                    <span class="text-danger">ملغي</span>
                    @break
                    @default
                    <span class="text-warnig">قيد الانجاز</span>
                     @endswitch
                     <h5 class="font-weight-blod card-title">
                         <a href="/projects/{{ $project->id }}"> {{ $project->title }} </a>
                     </h5>   
                     <div class="card-text mt-4">
                         {{ $project->description }}
                     </div>
                  @include('projects.footer')
            </div>
        </div>
    </div>
    {{-- الجزء الخاص بختيار حالة المشروع --}}
    <div class="card">
        <div class="card-body">
            <form action="" method="POST" >
                @csrf
                @method("PATCH")
                <select name="status"  class="form-select form-select-lg mb-3" onchange="this.form.submit()">
                    <option value="0" {{($project->status ==0) ? 'selected':''}}>قيد الانجاز</option>
                    <option value="1" {{($project->status ==1) ? 'selected':''}}>مكتمل</option>
                    <option value="2" {{($project->status ==2) ? 'selected':''}}>ملغي</option>
                </select>
            </form>
        </div>
    </div>

    </div>
    <div class="col-lg-8">
      @foreach ($project->tasks as $task)
          <div class="card d-felx felx-row">
              <div class="{{$task->done ? 'checked' : ''}} ">
                     {{$task->body}}
              </div>
             <div class="mr-auto">
                <form action="/projects/{{$project->id}}/tasks/{{$task->id}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="checkbox"  name="done" class="form-check ml-4"  {{$task->done ? 'checked' : ''}}  onchange="this.form.submit()">
                </form>
            </div>
            {{-- علشان نعمل ايقونة الحذف --}}
        <div class="d-flex align-items-center ">
            <form action="/projects/{{$task->project_id}}/tasks/{{$task->id}}" method="POST">
                {{-- /project/1/tasks/2--}}
            @method('DELETE')
            @csrf
                <input type="submit" class="btn-delete" value="" >
            </form>
         </div>
       </div>
      @endforeach
      <div class="card">
          <form action="/projects/{{$project->id}}/tasks" method="Post">
              @csrf
              <input type="text" name="body" class="form-control p-2 ml-2 text-center" placeholder="أضف مهمة جديدة ">
              <button type="submit" class="btn btn-primary"> إضافة</button>
          </form>
      </div>
    </div>
</section>
@endsection