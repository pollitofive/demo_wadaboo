<script src="{{ asset('monster/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('monster/js/custom-datatable.js') }}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script>
    function declareDatatable(name)
    {
        $('#'+name).DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf'
            ],
            language: {
                url: "@lang('components.datatable_languaje')",
                search: "_INPUT_",
                searchPlaceholder: " ",
            }
        });

    }

    //=============================================//
    //    File export                              //
    //=============================================//
    @if(is_array($table_name))
        @foreach($table_name as $name)
            declareDatatable('{{ $name }}');
        @endforeach
    @else
        declareDatatable('{{ $table_name }}');
    @endif
</script>
