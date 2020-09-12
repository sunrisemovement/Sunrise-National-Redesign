/*  This script is used for the widget on the admin dashboard to make an ajax call that updates the everyaction data
 *  It was pulled from an example in the url below.
 *  https://wordpress.stackexchange.com/questions/301687/create-small-dashboard-widget 
*/
jQuery("#ea_form").submit(function(event) {
    /* stop form from submitting normally */
    event.preventDefault();
    /* get the action attribute from the form element */
    var url = jQuery( this ).attr( 'action' );
    var formAction = jQuery("#ea_action").val();
    /* Send the data using post */
    jQuery.ajax({
        type: 'POST',
        url: url,
        data: {
            action: formAction,
        },
        success: function (data, textStatus, XMLHttpRequest) {
            alert(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
   });
 
 });