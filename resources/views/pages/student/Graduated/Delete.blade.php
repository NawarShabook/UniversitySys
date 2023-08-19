<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_Student{{$graduated->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">Delete Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('Graduateds.destroy',$graduated->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="id" value="{{$graduated->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">هل انت متأكد من حذف بيانات الطالب </h5>
                    <input type="text" readonly value="{{$graduated->student->name}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button  class="btn btn-danger">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
