<footer class="footer mt-auto">
    <div class="copyright bg-white">
        <p>
            &copy; <span id="copy-year"></span> Copyright Dashboard by ElPato
        </p>
    </div>
    <script>
        var d = new Date();
        var year = d.getFullYear();
        document.getElementById("copy-year").innerHTML = year;
    </script>
</footer>

{{-- colors table create drops --}}
<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#status').change(function() {
                var selectedValue = $(this).val();
                var backgroundColor;
                var textColor;

                switch (selectedValue) {
                    case 'Ready':
                        backgroundColor = '#82FB6A';
                        textColor = 'black';
                        break;
                    case 'Suspense':
                        backgroundColor = '#424945';
                        textColor = 'white';
                        break;
                    case 'Dont send':
                        backgroundColor = '#F1DD50';
                        textColor = 'black';
                        break;
                    case 'Problem':
                        backgroundColor = '#FF7059';
                        textColor = 'white';
                        break;
                    default:
                        backgroundColor = '#fff'; // Cor padrão
                        textColor = 'black'; // Cor padrão
                }

                $(this).css('background-color', backgroundColor);
                $(this).css('color', textColor);
            })
            .change(); // Este gatilho faz com que a função de mudança seja chamada imediatamente após a página ser carregada.
    });
</script>


<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#status').change(function() {
            var selectedValue = $(this).val();
            var backgroundColor;
            var textColor;

            switch (selectedValue) {
                case 'FTID Created':
                    backgroundColor = '#85f36e';
                    textColor = 'black';
                    break;
                case 'FTID Paid':
                    backgroundColor = '#bfddf3';
                    textColor = 'black';
                    break;
                case 'FTID Dropped':
                    backgroundColor = '#cf9bcc';
                    textColor = 'black';
                    break;
                case 'FTID Error':
                    backgroundColor = '#ff9e8e';
                    textColor = 'black';
                    break;
                default:
                    backgroundColor = '#fff'; // Cor padrão
                    textColor = 'black'; // Cor padrão
            }

            $(this).css('background-color', backgroundColor);
            $(this).css('color', textColor);
        }).change(); // Este gatilho faz com que a função de mudança seja chamada imediatamente após a página ser carregada.
    });
</script>


<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/simplebar/simplebar.min.js"></script>
<script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
<script src="plugins/apexcharts/apexcharts.js"></script>

<script src="plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>
<script src="plugins/daterangepicker/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>

<script>
    jQuery(document).ready(function() {
        jQuery('input[name="dateRange"]').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            locale: {
                cancelLabel: 'Clear'
            }
        });
        jQuery('input[name="dateRange"]').on('apply.daterangepicker', function(ev, picker) {
            jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
        });
        jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function(ev, picker) {
            jQuery(this).val('');
        });
    });
</script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script src="plugins/toaster/toastr.min.js"></script>

<script src="js/mono.js"></script>
<script src="js/chart.js"></script>
<script src="js/map.js"></script>
<script src="js/custom.js"></script>
