@if(\Session::has('error') or \Session::has('success'))
    <div class="modal hide" id="modal_session_message" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">システムメッセージ</h5>
                </div>
                <div class="modal-body">
                    <div id="session_message">
                        @if(\Session::has('success'))
                            <div class="success">
                                {!! nl2br(\Session::get('success')) !!}
                            </div>
                        @elseif(\Session::has('error'))
                            <div class="error">
                                {!! nl2br(\Session::get('error')) !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif