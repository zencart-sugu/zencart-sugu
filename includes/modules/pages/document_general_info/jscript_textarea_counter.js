/* javascript function to update form field
 *  field		form field that is being counted
 *  count		form field that will show characters left
 *  maxchars 	maximum number of characters
*/
function characterCount(field, count, maxchars) {
	if (field.value.length > maxchars) {
		field.value = field.value.substring(0, maxchars);
		alert("Error:\n\n- You are only allowed to enter up to "+maxchars+" characters.");
	} else {
		count.value = maxchars - field.value.length;
	}
}
