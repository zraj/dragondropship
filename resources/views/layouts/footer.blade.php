@if( $flash = session('message'))
<div id="flash-message" class="alert alert-success alert-dismissible fade show col-6" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
     <strong>{{ $flash }}</strong>

</div>
@endif



<footer class="app-footer">
        <a href="#">Dragon Dropship</a> © 2017
        {{-- <span class="float-right">Powered by <a href="http://coreui.io">CoreUI</a> --}}
        </span>
</footer>


    <!-- Bootstrap and necessary plugins -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('bower_components/tether/dist/js/tether.min.js')}}"></script>
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('bower_components/pace/pace.min.js')}}"></script>


    <!-- Plugins and scripts required by all views -->
    <script src="{{asset('bower_components/chart.js/dist/Chart.min.js')}}"></script>


    <!-- GenesisUI main scripts -->

    <script src="{{asset('js/app.js')}}"></script>

    {{-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> --}}
    <script src="{{asset('js/axios.min.js')}}" charset="utf-8"></script>
    {{-- <script src="https://unpkg.com/vue@2.4.2/dist/vue.js"></script> --}}
    <script src="{{asset('js/vue.js')}}" charset="utf-8"></script>
    <script src="{{asset('js/app2.js')}}"></script>


    <!-- Plugins and scripts required by this views -->

    <!-- Custom scripts required by this view -->
    <script src="{{asset('js/views/main.js')}}"></script>
<script type="text/javascript">
    $( document ).ready(function() {
    $( ".input-focus" ).focus();
    });
</script>
