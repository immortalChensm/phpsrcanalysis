``` 
typedef struct _zend_utility_functions {
	void (*error_function)(int type, const char *error_filename, const uint error_lineno, const char *format, va_list args) ZEND_ATTRIBUTE_PTR_FORMAT(printf, 4, 0);
	size_t (*printf_function)(const char *format, ...) ZEND_ATTRIBUTE_PTR_FORMAT(printf, 1, 2);
	size_t (*write_function)(const char *str, size_t str_length);
	FILE *(*fopen_function)(const char *filename, zend_string **opened_path);
	void (*message_handler)(zend_long message, const void *data);
	zval *(*get_configuration_directive)(zend_string *name);
	void (*ticks_function)(int ticks);
	void (*on_timeout)(int seconds);
	int (*stream_open_function)(const char *filename, zend_file_handle *handle);
	size_t (*vspprintf_function)(char **pbuf, size_t max_len, const char *format, va_list ap);
	zend_string *(*vstrpprintf_function)(size_t max_len, const char *format, va_list ap);
	char *(*getenv_function)(char *name, size_t name_len);
	zend_string *(*resolve_path_function)(const char *filename, int filename_len);
} zend_utility_functions;
```