## just  simple analyse source code of php-src    
是的，自己高兴爱怎么分析就怎么分析   
要是分析错了，错了就错了，又没吊大的大佬说我...       

###  fpm workflow code analysis   
1. fpm_main       
[sapi_module_struct](code/sapi.md) 

```c     
code fileName:sapi/fpm/fpm/fpm_main.c    

static sapi_module_struct cgi_sapi_module = {
	"fpm-fcgi",						/* name */
	"FPM/FastCGI",					/* pretty name */

	php_cgi_startup,				/* startup */
	php_module_shutdown_wrapper,	/* shutdown */

	sapi_cgi_activate,				/* activate */
	sapi_cgi_deactivate,			/* deactivate */

	sapi_cgibin_ub_write,			/* unbuffered write */
	sapi_cgibin_flush,				/* flush */
	NULL,							/* get uid */
	sapi_cgibin_getenv,				/* getenv */

	php_error,						/* error handler */

	NULL,							/* header handler */
	sapi_cgi_send_headers,			/* send headers handler */
	NULL,							/* send header handler */

	sapi_cgi_read_post,				/* read POST data */
	sapi_cgi_read_cookies,			/* read Cookies */

	sapi_cgi_register_variables,	/* register server variables */
	sapi_cgi_log_message,			/* Log message */
	NULL,							/* Get request time */
	NULL,							/* Child terminate */

	STANDARD_SAPI_MODULE_PROPERTIES
};

  
   
int main(int argc, char *argv[])
{
	int exit_status = FPM_EXIT_OK;
	int cgi = 0, c, use_extended_info = 0;
	zend_file_handle file_handle;

	/* temporary locals */
	int orig_optind = php_optind;
	char *orig_optarg = php_optarg;
	int ini_entries_len = 0;
	/* end of temporary locals */

	int max_requests = 500;
	int requests = 0;
	int fcgi_fd = 0;
	fcgi_request *request;
	char *fpm_config = NULL;
	char *fpm_prefix = NULL;
	char *fpm_pid = NULL;
	int test_conf = 0;
	int force_daemon = -1;
	int force_stderr = 0;
	int php_information = 0;
	int php_allow_to_run_as_root = 0;
	
	if (argc != php_optind) {
    		cgi_sapi_module.startup(&cgi_sapi_module);
    		//call php_cgi_startup 845
    		php_output_activate();
    		SG(headers_sent) = 1;
    		php_cgi_usage(argv[0]);
    		php_output_end_all();
    		php_output_deactivate();
    		fcgi_shutdown();
    		exit_status = FPM_EXIT_USAGE;
    		goto out;
    	}
}   

static zend_module_entry cgi_module_entry;

static int php_cgi_startup(sapi_module_struct *sapi_module) /* {{{ */
{
	//main main.c 2078
    if (php_module_startup(sapi_module, &cgi_module_entry, 1) == FAILURE) {
		return FAILURE;
	}
	return SUCCESS;
}
```    
[php_cgi_startup](code/php_cgi_startup.md) 
[_zend_module_entry](code/zend.md) 