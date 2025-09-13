export interface IConfigType {
    // Request configuration
    url?: string;
    method?: 'GET' | 'POST' | 'PUT' | 'DELETE' | 'PATCH' | 'HEAD' | 'OPTIONS';
    baseURL?: string;
    headers?: Record<string, string>;
    params?: Record<string, any>;
    data?: any;
    timeout?: number;
    
    // Authentication
    auth?: {
        username: string;
        password: string;
    };
    
    // Response configuration
    responseType?: 'json' | 'text' | 'blob' | 'arraybuffer' | 'document' | 'stream';
    responseEncoding?: string;
    
    // Request/Response transformation
    transformRequest?: Array<(data: any, headers: Record<string, string>) => any>;
    transformResponse?: Array<(data: any) => any>;
    
    // Adapters and interceptors
    adapter?: any[];
    
    // Validation
    validateStatus?: (status: number) => boolean;
    
    // Redirects
    maxRedirects?: number;
    maxContentLength?: number;
    maxBodyLength?: number;
    
    // Proxy configuration
    proxy?: {
        protocol?: string;
        host: string;
        port: number;
        auth?: {
            username: string;
            password: string;
        };
    } | false;
    
    // SSL/TLS
    httpsAgent?: any;
    httpAgent?: any;
    
    // Cookies and state
    withCredentials?: boolean;
    
    // Progress tracking
    onUploadProgress?: (progressEvent: any) => void;
    onDownloadProgress?: (progressEvent: any) => void;
    
    // Request cancellation
    signal?: AbortSignal;
    cancelToken?: any;
    
    // Transitional options
    transitional?: {
        silentJSONParsing?: boolean;
        forcedJSONParsing?: boolean;
        clarifyTimeoutError?: boolean;
    };
    
    // Response data (populated after request)
    message?: any;
    request?: XMLHttpRequest;
    status?: number;
    statusText?: string;
    
    // Additional metadata
    metadata?: {
        startTime?: number;
        endTime?: number;
        duration?: number;
        retryCount?: number;
        cached?: boolean;
    };
}