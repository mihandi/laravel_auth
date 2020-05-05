$(document).ready(function () {
    function fetch_data(sort_type, sort_by) {

        var url = 'user?sort_by=' + sort_by + '&sort_type=' + sort_type;

        var filterParams = getFilterParams();

        if (Object.keys(filterParams).length > 0) {
            for (key in filterParams) {
                url += ('&s_' + key + '=' + encodeURI(filterParams[key]));
            }
        }

        $.ajax({
            url: url,
            success:function (data) {
                $('tbody').html('');
                $('tbody').html(data);
            }
        });
    }

    function getFilterParams(){

        var filters = [];

        $('.filter-input').each(function() {
            if ($(this).val() != ''){
                filters[$(this).data('column')] = $(this).val();
            }
        });

        return filters;
    }

    $(document).on('click', '.sorting', function () {
        var column_name = $(this).data('column_name');
        var order_type = $(this).data('sort_type');
        var reverse_order = '';

        $('.sorting i').removeClass('active');

        if (order_type == 'asc') {
            $(this).data('sort_type', 'desc');
            reverse_order = 'desc';
            $('#' + column_name+'_icon').addClass('fa-sort-alpha-desc');
            $('#' + column_name+'_icon').removeClass('fa-sort-alpha-asc');
        } else if (order_type == 'desc') {
            $(this).data('sort_type', 'asc');
            reverse_order = 'asc';
            $('#' + column_name+'_icon').addClass('fa-sort-alpha-asc');
            $('#' + column_name+'_icon').removeClass('fa-sort-alpha-desc');
        }

        $('#' + column_name+'_icon').addClass('active');

        $('#sort_column_name').val(column_name);
        $('#sort_type').val(reverse_order);

        fetch_data(reverse_order, column_name);
    });

    $(document).on('change submit',function () {
        var sort_column_name = $('#sort_column_name').val();
        var reverse_order =  $('#sort_type').val();

        fetch_data(reverse_order, sort_column_name);
    })
});
