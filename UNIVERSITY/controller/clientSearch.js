$(document).ready(initialisePage);

function initialisePage()
{
  $("div#niceajaxsearch input").keyup(handleAutoComplete);
  $("input#ajaxsearchbutton").click(ajaxSearch);
}

////////////////////////// AUTOCOMPLETE SHOWCASES ///////////////////////////////////

////////////////////////// PRETTY JSON AJAX CODE //////////////////////////////////

function handleAutoComplete()
{
  var search = $("div#niceajaxsearch input").val().trim();
  if (search != "")
  {
    $.get("https://kunet.uk/teal/UNIVERSITY/controller/findRecipe.php?recipe="+search,AutoCompleteCallback);
  }
  else // if search IS empty
  {
    $("div#niceajaxsearch div.results").hide();
  }
}

function AutoCompleteCallback(results)
{
    // contrast the ugly version!
    // note how we don't need to do any parsing - results will already
    // be an array!
    console.log(results);
    // build the results div
    $("div#niceajaxsearch div.results").empty();
    for (var i = 0; i < results.length; i++)
    {
      var result = $('<div class="result">'+results[i]+'</div>');
      result.click(function(){
        $("div#niceajaxsearch div.results").hide();
        $("input[name=inputRecipe]").val($(this).text());
        $("form").get(0).submit();
      });
      $("div#niceajaxsearch div.results").append(result);
    }
    if (results.length == 0)
    {
      $("div#niceajaxsearch div.results").hide();
    }
    else {
      $("div#niceajaxsearch div.results").show();
    }
}

//////////////////// AJAX SEARCH ///////////////////////////////////////////

function ajaxSearch()
{
  var search = $("input[name=ajaxsearchRecipe]").val().trim();
  $.get("https://kunet.uk/teal/UNIVERSITY/controller/findRecipe.php?recipe="+search,ajaxSearchCallback);
}

function ajaxSearchCallback(results)
{
  // results will be an array of Javascript objects which precisely match
  // the Customer objects in PHP land.

  // wipe out the existing rows in the table seeing as how we're replacing them
  $("table#resultstable tbody").empty();
  // now we can iterate through results
  for (var i = 0; i < results.length; i++)
  {
    var recipe = results[i];
    // build a new table row
    var newrow = $("<tr></tr>");
    // just so we can see the difference between AJAX-generated rows and
    newrow.append("<td>"+recipe.recipeName+"</td>");

    // normal rows

    // append the new row to the table
    $("table#resultstable tbody").append(newrow);
  }
}
