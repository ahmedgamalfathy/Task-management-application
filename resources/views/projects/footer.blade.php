<div class="card-footer" dir="rtl">
    <div class="d-flex">
            <div class="d-flex align-items-center m-3 ">
                <img src="/images/clock.svg" alt="">
                <div class="mr-2">
                    {{ $project->created_at->diffForHumans() }}
                    <!-- التابع الدف هيومن مسؤول عن حساب المدة الزمنية من وقت انشاء المشروع الي الوقت الحالي -->
                </div>
                </div>
            <div class="d-flex align-items-center m-4 ">
                <img src="/images/list-check.svg" alt="">
                <div class="mr-2">
                 {{count($project->tasks)}}
                </div>
            </div>    
                <div class="d-flex align-items-center mr-auto ">
                    <form action="/projects/{{ $project->id }}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn-delete" value="" />
                    </form>
               </div>
    </div>
</div>