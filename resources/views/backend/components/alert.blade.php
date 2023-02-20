@if(!empty($errors->all()))
    <div id="notif" class="alert alert-dismissible alert-danger alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <div class="alert-title">Error!</div>
            Mohon periksa isian anda kembali.
        </div>
    </div>
@endif