
export function downloadFile(urlPath : string) {

    const link : HTMLAnchorElement = document.createElement('a');
    link.href = urlPath;
    link.setAttribute('download', "");
    link.click();
}