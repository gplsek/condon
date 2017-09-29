UPDATE `wp_options` SET `option_value` = REPLACE( `option_value`, "http://cj", "http://cj.dev.cpcs.ws") WHERE `option_name` IN ("siteurl", "home");

UPDATE `wp_es_pluginconfig` SET
`es_c_optinlink` = 'http://cj.dev.cpcs.ws/?es=optin&db=###DBID###&email=###EMAIL###&guid=###GUID###',
`es_c_unsublink` = 'http://cj.dev.cpcs.ws/?es=unsubscribe&db=###DBID###&email=###EMAIL###&guid=###GUID###'
WHERE `es_c_id` = '1';
