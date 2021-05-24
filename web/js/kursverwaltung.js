$(document).ready(function () {
    $(".dynamicform_wrapper").on("afterInsert", function (e, item) {
        var $hasDatepicker = $(".dynamicform_wrapper div.timepicker:last").find('.form-control');
        if ($hasDatepicker.length > 0) {
            $hasDatepicker.each(function () {
                $hasDatepicker.prop("disabled", false);
                $(this).parent().removeData().datetimepicker('remove');
                $(this).parent().datetimepicker({
                    convertFormat: true,
                    format: 'dd.mm.yyyy hh:ii',
                    autoclose: true,
                });
            });
        }
    });
});