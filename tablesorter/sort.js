$(function() {

  $(".tablesorter")
    .tablesorter({
      theme : 'rea',
      // this is the default setting
      cssChildRow: "tablesorter-childRow",

      // initialize zebra and filter widgets
      widgets: ["filter"],//, "pager"],

      widgetOptions: {
        // output default: '{page}/{totalPages}'
        // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
        //pager_output: '{startRow} - {endRow} / {filteredRows} ({totalRows})', // '{page}/{totalPages}'
        //pager_removeRows: false,


        // include child row content while filtering, if true
        filter_childRows  : true,
        // class name applied to filter row and each input
        filter_cssFilter  : 'tablesorter-filter',
        // search from beginning
        filter_startsWith : false,
        // Set this option to false to make the searches case sensitive 
        filter_ignoreCase : true
      }

    });

  // hide child rows
  //$('.tablesorter-childRow td').hide();

  // Toggle child row content (td), not hiding the row since we are using rowspan
  // Using delegate because the pager plugin rebuilds the table after each page change
  // "delegate" works in jQuery 1.4.2+; use "live" back to v1.3; for older jQuery - SOL
  /*$('.tablesorter').delegate('.toggle', 'click' ,function(){

    // use "nextUntil" to toggle multiple child rows
    // toggle table cells instead of the row
    $(this).closest('tr').nextUntil('tr.tablesorter-hasChildRow').find('td').toggle();

    return false;
  });

  // Toggle widgetFilterChildRows option
  /*$('button.toggle-option').click(function(){
    var c = $('.tablesorter')[0].config.widgetOptions,
    o = !c.filter_childRows;
    c.filter_childRows = o;
    $('.state').html(o.toString());
    // update filter; include false parameter to force a new search
    $('table').trigger('search', false);
    return false;
  });*/

});