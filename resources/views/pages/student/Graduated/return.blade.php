<!-- Deleted inFormation Student -->
<div class="modal fade" id="Return_Student{{$graduated->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">ارجاع طالب</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('Graduateds.update',$graduated->id)}}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{$graduated->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">هل انت متاكد من الغاء عملية التخرج ؟</h5>
                    <input type="text" readonly value="{{$graduated->student->name}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  class="btn btn-danger">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
