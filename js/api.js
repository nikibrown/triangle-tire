/**
 * Ajax post API function
 *
 * Takes set of params associated with prespecified inputs
 * parameters = new Object();
 * parameters.uri = 'http://something.com/image.jpg';
 * parameters.label = 'Awesome pic';
 * parameters.created = '2012-01-01';
 * api('api/process/', parameters, function(data){
 *      console.log(data);
 * });
 */
function api(endpoint, parameters, callback){
    
    if(typeof(site_options) === 'undefined') {
        console.log('No site options defined.');
    }
    var api_parameters = 'randkey='+new Date().getTime();
    
    if(parameters instanceof Array){
        $.each(parameters, function(key, value) {
            parameters += '&'+key+'='+value;
        });    
    }
    
    ajax_url = site_options.base + '/'+endpoint+'/'; 
    
    $.ajax
    ({
        type: "POST",
        url: ajax_url, 
        data: parameters, 
        success: callback, 
        error: function(){
            console.log('Error retrieving data from ' + ajax_url);
        }
    });                
}


/*******************************
 Function to allow tracking of google analytics events
********************************/
function track_action(category, event, string, value)
{
    if(typeof ga == 'undefined'){
        console.log('ga is undefined: ' + category + ' ' + event + ' ' + string);
    } else {
        ga('send', 'event', category, event, string, value);  // value is a number.
    }
}