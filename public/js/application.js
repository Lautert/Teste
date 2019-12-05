/*! Application - v0.0.0 - 2019-12-04 */
$("body").on("click", "fieldset legend", function() {
    $(this).parents("fieldset:eq(0)").find("div").toggle();
});