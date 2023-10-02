@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('add'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ trans('Dashboard/message_trans.Add') }}",
                type: "success"
            });
        }
    </script>
@endif

@if (session()->has('edit'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ trans('Dashboard/message_trans.Edit') }}",
                type: "success"
            });
        }
    </script>
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ trans('Dashboard/message_trans.Delete') }}",
                type: "success"
            });
        }
    </script>
@endif
