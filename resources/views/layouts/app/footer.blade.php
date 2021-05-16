
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/dropify.min.js')}}"></script>

        <script>
		    $(document).ready(function() {
		      @if(session('success'))
		        var color = 'success';
		        var message = '{{session('success')}}';
		        $.notify({
		          icon: "i-con i-con-bell",
		          message: message

		        },{
		            type: color,
		            allow_dismiss: true,
		            placement: {
		                from: "top",
		                align: "right"
		            },
		            animate: {
		                enter: 'animated fadeInDown',
		                exit: 'animated fadeOutUp'
		            },
		            delay:60000
		        });
		      @elseif(session('error') || session('failed'))
		        var color = 'danger';
		        var message = '{{ session('error') }}';
		        $.notify({
		          icon: "i-con i-con-bell",
		          message: message

		        },{
		            type: color,
		            allow_dismiss: true,
		            placement: {
		                from: "top",
		                align: "right"
		            },
		            animate: {
		                enter: 'animated fadeInDown',
		                exit: 'animated fadeOutUp'
		            },
		            delay:60000
		        });
		      @endif

		    });
		  </script>

        @stack('scripts')
    </body>
</html>
