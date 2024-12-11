<div class="modal-content">
   <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">
         {{@$page_title}}
      </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">
      ×
      </span>
      </button>
   </div>
   <form action="{{$action}}" method="post" class="exportable"  >
      <div class="modal-body">
         <div class="row">
            <div class="col-md-12">
               {!! csrf_field() !!}
               <div class="form-group">
                  @if($exportable)
                  <div class="mt-checkbox-list">
                     @foreach($exportable as $key=>$val)
                     <label class="mt-checkbox mt-checkbox-outline"> {{$val}}
                     <input type="checkbox" value="{{$val}}" name="exportable[{{$key}}]" />
                     <span></span>
                     </label>
                     @endforeach
                  </div>
                  @endif
               </div>
            </div>
         </div>
      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-info m-btn m-btn--icon" ><span><i class="la la-plus"></i><span>Export</span></span></button>
         <button type="button" class="btn btn-secondary m-btn m-btn--icon" data-dismiss="modal"><span>Close</span></button>
      </div>
   </form>
</div>