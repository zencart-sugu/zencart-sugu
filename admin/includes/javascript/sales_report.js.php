<?php
/*
//////////////////////////////////////////////////////////
//  SALES REPORT                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2006 The Zen Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION: All the javascript code specific to    //
//  the Sales Report resides in this file.  Covers the  //
//  reports on-screen dynamic abilities and pre-launch  //
//  form checking.                                      //
//////////////////////////////////////////////////////////
// $Id: sales_report.js.php 99 2006-09-25 01:02:31Z BlindSide $
*/
?>
<script language="javascript" type="text/javascript"><!--
<?php
/*
////////////
// Function    : popupWindow
// Arguments   : none
// Description : loads a new window when option is checked
///////////////
*/
?>
  function popupWindow() {
    window.open('', 'sr_popup');
    // for a list of features:
    // http://www.devguru.com/technologies/ecmascript/quickref/win_open.html
  }


<?php
/*
////////////
// Function    : populate_search
// Arguments   : boolean "load_defaults"
// Description : fills in search parameters to match last search, or
//               default settings when loaded clean or default button is clicked
///////////////
*/
?>
  function populate_search(load_defaults) {
    var output_format = '<?php echo $output_format; ?>';
    // returning from print view sets $output_format to 'none'. This
    // exception catches and corrects the illegal value, resetting
    // its JavaScript counterpart to 'print'
    if (output_format == 'none') output_format = 'print';

    if (!output_format || (arguments.length == 1 && load_defaults) ) {
      var date_search_type = '<?php echo DEFAULT_DATE_SEARCH_TYPE; ?>';
      var date_preset = '<?php echo DEFAULT_DATE_PRESET; ?>';
      var start_date = '<?php echo DEFAULT_START_DATE; ?>';
      var end_date = '<?php echo DEFAULT_END_DATE; ?>';

      var date_target = '<?php echo DEFAULT_DATE_TARGET; ?>';
      var date_status = '<?php echo DEFAULT_DATE_STATUS; ?>';
      var payment_method = '<?php echo DEFAULT_PAYMENT_METHOD; ?>';
      var current_status = '<?php echo DEFAULT_CURRENT_STATUS; ?>';
      var manufacturer = '<?php echo DEFAULT_MANUFACTURER; ?>';

      var timeframe = '<?php echo DEFAULT_TIMEFRAME; ?>';
      var timeframe_sort = '<?php echo DEFAULT_TIMEFRAME_SORT; ?>';
      var detail_level = '<?php echo DEFAULT_DETAIL_LEVEL; ?>';
      if (detail_level == 'product' || detail_level == 'order') {
        var li_sort_a = '<?php echo DEFAULT_LI_SORT_A; ?>';
        var li_sort_order_a = '<?php echo DEFAULT_LI_SORT_ORDER_A; ?>';
        var li_sort_b = '<?php echo DEFAULT_LI_SORT_B; ?>';
        var li_sort_order_b = '<?php echo DEFAULT_LI_SORT_ORDER_B; ?>';
      }

      var output_format = '<?php echo DEFAULT_OUTPUT_FORMAT; ?>';
      var auto_print = '<?php echo DEFAULT_AUTO_PRINT; ?>';
      var csv_header = '<?php echo DEFAULT_CSV_HEADER; ?>';
    }
    else {
      var date_preset = '<?php echo $date_preset; ?>';
      if (date_preset) {
        var date_search_type = 'preset';
      } else {
        var date_search_type = 'custom';
      }
      var start_date = '<?php echo $start_date; ?>';
      var end_date = '<?php echo $end_date; ?>';

      var date_target = '<?php echo $date_target; ?>';
      var date_status = '<?php echo $date_status; ?>';
      var payment_method = '<?php echo $payment_method; ?>';
      var current_status = '<?php echo $current_status; ?>';
      var manufacturer = '<?php echo $manufacturer; ?>';

      var timeframe = '<?php echo $timeframe; ?>';
      var timeframe_sort = '<?php echo $timeframe_sort; ?>';
      var detail_level = '<?php echo $detail_level; ?>';
      var li_sort_a = '<?php echo $li_sort_a; ?>';
      var li_sort_order_a = '<?php echo $li_sort_order_a; ?>';
      var li_sort_b = '<?php echo $li_sort_b; ?>';
      var li_sort_order_a = '<?php echo $li_sort_order_b; ?>';

      var auto_print = '<?php echo $auto_print; ?>';
      var csv_header = '<?php echo $csv_header; ?>';
    }


    // sets date range (custom + custom dates -or- preset + selection)
    switch (date_search_type) {
      case 'preset':
        swap_date_search('date_custom');
        auto_select_input(date_preset, 'date_preset', 'option');
      break;
      case 'custom':
        swap_date_search('date_preset');
        var sd_text = document.getElementsByName('start_date');
        var ed_text = document.getElementsByName('end_date');
        sd_text[0].value = start_date;
        ed_text[0].value = end_date;
      break;
      default:
        swap_date_search('date_custom');
      break;
    }

    // date_target (+ optional target status)
    auto_select_input(date_target, 'date_target', 'option');
    switch (date_target) {
      case 'status':
        auto_select_input(date_status, 'date_status', 'select');
        show('td_date_status');
      break;
      case 'purchased':
      default:
        hide('td_date_status');
      break;
    }

    // payment method
    auto_select_input(payment_method, 'payment_method', 'select');

    // current status
    auto_select_input(current_status, 'current_status', 'select');

    // current status
    auto_select_input(manufacturer, 'manufacturer', 'select');

    // timeframe
    auto_select_input(timeframe, 'timeframe', 'option');

    // timeframe sort
    auto_select_input(timeframe_sort, 'timeframe_sort', 'option');

    // detail level
    auto_select_input(detail_level, 'detail_level', 'select');
    if (detail_level == '') detail_level = 'timeframe';
    set_sort_options(detail_level);

    // optional sort parameters
    if (detail_level == 'product' || detail_level == 'order') {
      auto_select_input(li_sort_a, 'li_sort_a', 'select');
      auto_select_input(li_sort_order_a, 'li_sort_order_a', 'option');
      auto_select_input(li_sort_b, 'li_sort_b', 'select');
      auto_select_input(li_sort_order_b, 'li_sort_order_b', 'option');
    }

    // output format (+ optional auto-print)
    auto_select_input(output_format, 'output_format', 'select');
    format_checkbox(output_format);
    if (auto_print) {
      document.search.auto_print.checked = true;
    }
    else if (csv_header) {
      document.search.csv_header.checked = true;
    }

  }  // END function populate_search()


<?php
/*
////////////
// Function    : swap_date_search
// Arguments   : string "current_view"
// Description : switches date range display from preset to custom, vice versa
///////////////
*/
?>
  function swap_date_search(current_view) {
    switch (current_view) {
      case 'date_preset':
        show('tbl_date_custom');
        hide('tbl_date_preset');

        // clear radio buttons
        var radio = document.getElementsByName('date_preset');
        var radio_length = radio.length;
        for(var i = 0; i < radio_length; i++) {
          radio[i].checked = false;
        }
      break;
      case 'date_custom':
        show('tbl_date_preset');
        hide('tbl_date_custom');

        // clear text boxes
        var sd_text = document.getElementsByName('start_date');
        var ed_text = document.getElementsByName('end_date');
        sd_text[0].value = "";
        ed_text[0].value = "";

        // set the default option for radio buttons
        var radio = document.getElementsByName('date_preset');
        radio[0].checked = true;
      break;
    }
  }


<?php
/*
////////////
// Function    : set_sort_options
// Arguments   : string "detail_level"
// Description : initializing function to set up or remove line item sort boxes
///////////////
*/
?>
  // toggles the display of the two line item sort boxes
  function set_sort_options(detail_level) {
    // set sort dropdown options
    var default_a = '<?php echo $li_sort_a; ?>';
    build_select(detail_level, document.search.li_sort_a);
    auto_select_input(default_a, 'li_sort_a', 'select');

    var default_b = '<?php echo $li_sort_b; ?>';
    build_select(detail_level, document.search.li_sort_b);
    auto_select_input(default_b, 'li_sort_b', 'select');

    // set visibility of sorting elements
    switch (detail_level) {
      case 'timeframe':
      case 'matrix':
        hide('div_li_table_a', true);
        hide('div_li_table_b', true);
      break;
      case 'product':
      case 'order':
        show('div_li_table_a');
        show('div_li_table_b');
      break;
    }
  }


<?php
/*
////////////
// Function    : show
// Arguments   : string "id"
// Description : Makes identified elment visible on page
///////////////
*/
?>
  function show(id) {
    var el = document.getElementById(id);
    el.style.visibility = 'visible';
    el.style.display = 'block';
  }


<?php
/*
////////////
// Function    : hide
// Arguments   : string "id", boolean "keep_display"
// Description : Removes element from the page; the second option allows the
//               space occupied by the element to remain intact
///////////////
*/
?>
  function hide(id, keep_display) {
    var el = document.getElementById(id);
    el.style.visibility = 'hidden';
    if (arguments.length > 1 && keep_display) {
      el.style.display = 'block';
    }
    else {
      el.style.display = 'none';
    }
  }


<?php
/*
////////////
// Function    : build_select
// Arguments   : string "view", element "sort_box"
// Description : performs the leg work of populating the line item sort boxes
//               with options according to the search type selected
///////////////
*/
?>
  function build_select(view, sort_box) {
    sort_box.options.length = 0;
    var sort_title = document.getElementById('span_sort_title');

    if (view == 'order') {
      // define text above first sort box
      sort_title.innerHTML = '<?php echo SEARCH_SORT_ORDER; ?>';


      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_ORDERS_ID; ?>', 'oID');
      sort_box.options[sort_box.options.length] = new Option('<?php echo SELECT_LAST_NAME; ?>', 'last_name');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_NUM_PRODUCTS; ?>', 'num_products');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_TOTAL_GOODS; ?>', 'goods');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_SHIPPING; ?>', 'shipping');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_DISCOUNTS; ?>', 'discount');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_GC_SOLD; ?>', 'gc_sold');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_GC_USED; ?>', 'gc_used');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_ORDER_TOTAL; ?>', 'grand');
    }
    else if (view == 'product') {
      // define text above first sort box
      sort_title.innerHTML = '<?php echo SEARCH_SORT_PRODUCT; ?>';

      sort_box.options[sort_box.options.length] = new Option('<?php echo SELECT_PRODUCT_ID; ?>', 'pID');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_PRODUCT_NAME; ?>', 'name');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_MANUFACTURER; ?>', 'manufacturer');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_MODEL; ?>', 'model');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_BASE_PRICE; ?>', 'base_price');
      sort_box.options[sort_box.options.length] = new Option('<?php echo SELECT_QUANTITY; ?>', 'quantity');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_ONETIME_CHARGES; ?>', 'onetime_charges');
      sort_box.options[sort_box.options.length] = new Option('<?php echo TABLE_HEADING_PRODUCT_TOTAL; ?>', 'grand');
    }
  }


<?php
/*
////////////
// Function    : auto_select_input
// Arguments   : string "default_option", element "input_obj", string "input_type"
// Description : general function used to select an option from a drop down or radio group
///////////////
*/
?>
  function auto_select_input(default_option, input_obj, input_type) {
    var option_found = false;
    switch (input_type) {
      case 'option':
        var option = document.getElementsByName(input_obj);
        for(var i = 0; i < option.length; i++) {
          if (option[i].value == default_option) {
            option[i].checked = true;
            option_found = true;
            break;
          }
        }
        if (!option_found) option[0].checked = true;
      break;
      case 'select':
        var select = document.getElementById(input_obj);
        for(var i = 0; i < select.options.length; i++) {
          if (select.options[i].value == default_option) {
            select.selectedIndex = i;
            option_found = true;
            break;
          }
        }
        if (!option_found) select.selectedIndex = 0;
      break;
    }
  }


<?php
/*
////////////
// Function    : clearDefault
// Arguments   : element "el"
// Description : clears default text from a text field when given cursor attention
///////////////
*/
?>
  function clearDefault(el) {
    if (el.defaultValue == el.value) el.value = "";
  }


<?php
/*
////////////
// Function    : format_checkbox
// Arguments   : string "current_output"
// Description : sets visibilty of checkboxes that appear depending
//               on the output format selected.
///////////////
*/
?>
  function format_checkbox(current_output) {
    switch (current_output) {
      case 'print':
        show('span_auto_print');
        hide('span_csv_header');
      break;
      case 'csv':
        hide('span_auto_print');
        show('span_csv_header');
      break;
      default:
        document.search.auto_print.checked = false;
        document.search.csv_header.checked = false;
        hide('span_auto_print');
        hide('span_csv_header');
      break;
    }
  }


<?php
/*
////////////
// Function    : form_check
// Arguments   : none
// Description : Checks the sales report search parameters; submits the search
//               if valid, alerts the user if there are problems
///////////////
*/
?>
  function form_check() {
    var ready_date = false;
    var date_valid = false;
    var compatible_csv = false;

    // check for a preset date selection
    var date_preset_set = false;
    var date_preset = document.getElementsByName('date_preset');
    for (var i = 0; i < date_preset.length; i++) {
      if (date_preset[i].checked) {
        date_preset_set = true;
        break;
      }
    }

    var start_date = document.search.start_date;
    var end_date = document.search.end_date;

    // check for a preset date range selection
    if (date_preset_set) {
      ready_date = true;
      date_valid = true;
    }
    // check for a custom date range
    else if (start_date.value != "" && end_date.value != "") {
      ready_date = true;

      // if there's a custom date range, we need to make sure both dates are valid
      var sd_string = start_date.value.toString();
      var ed_string = end_date.value.toString();

//      var date_delim = sd_string.charAt(2);
      var date_delim = sd_string.charAt(4);

      var sd_array = sd_string.split( date_delim );
      var ed_array = ed_string.split( date_delim );

//      if (isDate(sd_array[1], sd_array[0], sd_array[2]) &&
//          isDate(ed_array[1], ed_array[0], ed_array[2]) ) {
      if (isDate(sd_array[2], sd_array[1], sd_array[0]) &&
          isDate(ed_array[2], ed_array[1], ed_array[0]) ) {
          // the array is in mm-dd-yyyy format, but isDate needs it in dd-mm-yyyy
        date_valid = true;
      }
      else {
        date_valid = false;
      }

      // in order to prevent timeouts and server overloads, we
      // should also make sure the date range isn't too big

    }
    else {
      ready_date = false;
      date_valid = true;  // 1 date-related error is enough
    }


    // make sure CSV output is not selected with the matrix detail level
    var detail_level = document.getElementById('detail_level');
    var output_format = document.getElementById('output_format');

    if ((detail_level.options[detail_level.selectedIndex].value == 'matrix' &&
        output_format.options[output_format.selectedIndex].value == 'csv') ||
	detail_level.options[detail_level.selectedIndex].value == 'timeframe' &&
        output_format.options[output_format.selectedIndex].value == 'csv') {
      var compatible_csv = false;
    }
    else {
      var compatible_csv = true;
    }

    // if everything checks out, submit the search
    if (ready_date && date_valid && compatible_csv) {
      document.search.btn_submit.disabled = true;
      show('td_wait_text');
      setTimeout('submit_timeout()', 5000);
      // check to see if we should open in a new window
      if (document.search.new_window.checked) {
        window.open('', 'sr_popup', '');
        document.search.target = 'sr_popup';
      }
      document.search.submit();
    }

    // otherwise alert the user and highlight the problem(s)
    else {
      var alert_start = "";
      var alert_date_invalid = "";
      var alert_date_missing = "";
      var alert_csv_conflict = "";
      var alert_finish = "";
      var error_count = 0;

      alert_start = "<?php echo ALERT_MSG_START; ?>"  + "\n \n";
      if (!date_valid) {
        alert_date_invalid = "<?php echo ALERT_DATE_INVALID; ?>" + "\n";

        start_date.style.backgroundColor = "<?php echo ALERT_JS_HIGHLIGHT; ?>";
        end_date.style.backgroundColor = "<?php echo ALERT_JS_HIGHLIGHT; ?>";

        error_count++;
      }

      if (!ready_date) {
        alert_date_missing = "<?php echo ALERT_DATE_MISSING; ?>" + "\n";

        var td_yesterday  = document.getElementById('td_yesterday');
        td_yesterday.style.color = "<?php echo ALERT_JS_HIGHLIGHT; ?>";
        td_yesterday.style.fontWeight = 'bold';

        var td_last_month = document.getElementById('td_last_month');
        td_last_month.style.color = "<?php echo ALERT_JS_HIGHLIGHT; ?>";
        td_last_month.style.fontWeight = 'bold';

        var td_this_month = document.getElementById('td_this_month');
        td_this_month.style.color = "<?php echo ALERT_JS_HIGHLIGHT; ?>";
        td_this_month.style.fontWeight = 'bold';

        start_date.style.backgroundColor = "<?php echo ALERT_JS_HIGHLIGHT; ?>";
        end_date.style.backgroundColor = "<?php echo ALERT_JS_HIGHLIGHT; ?>";

        error_count++;
      }

      if (!compatible_csv) {
        alert_csv_conflict = "<?php echo ALERT_CSV_CONFLICT; ?>" + "\n";
        detail_level.style.backgroundColor = "<?php echo ALERT_JS_HIGHLIGHT; ?>";
        output_format.style.backgroundColor = "<?php echo ALERT_JS_HIGHLIGHT; ?>";

        error_count++;
      }
      alert_finish = "\n" + "<?php echo ALERT_MSG_FINISH; ?>";

      var msg = alert_start +
                alert_date_invalid +
                alert_date_missing +
                alert_csv_conflict +
                alert_finish;

      alert(msg);
    }
  }


<?php
/*
////////////
// Function    : submit_timeout
// Arguments   : none
// Description : re-enables the submit button when CSV or new window options
//               are selected.  Prevents "breaking" the submit button.
///////////////
*/
?>
  function submit_timeout() {
    var format = document.search.output_format.options[document.search.output_format.selectedIndex].value;
    if (format == 'csv' || document.search.new_window.checked) {
      hide('td_wait_text');
      document.search.btn_submit.disabled = false;
    }
  }


<?php
/*
////////////
// Function    : img_over
// Arguments   : element "img_name", string "img_src"
// Description : replaces source of img_name with image identified in img_src
///////////////
*/
?>
  function img_over(img_name, img_src) {
    var img = document.getElementById(img_name);
    img.src = img_src;
  }


<?php
/*
////////////
// Function    : isDate
// Arguments   : string "day", string "month", string "year"
// Description : checks if passed date is valid
//               (e.g. returns false for Feb. 29 or Sept. 31)
///////////////
*/
?>
  function isDate(day, month, year) {

    var today = new Date();

    year = ((!year) ? today.getFullYear() : year);
    month = ((!month) ? today.getMonth() : month - 1);
    // subtract 1 because date.getMonth() numbers months 0 - 11
    if (!day) {
      return false;
    }

    var test = new Date(year, month, day);
    if ( (year == test.getFullYear()) &&
         (month == test.getMonth()) &&
         (day == test.getDate()) ) {
      return true;
    }
    else {
      return false;
    }
  }
--></script>