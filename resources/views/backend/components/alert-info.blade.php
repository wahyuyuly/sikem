@if(session()->has('result.message'))
    <div id="notif" class="alert alert-dismissible alert-{{ session()->get('result.type') }} alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            <div class="alert-title">{{ session()->get('result.title') }}</div>
            {{ session()->get('result.message') }}
        </div>
    </div>
@endif