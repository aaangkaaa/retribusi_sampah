
function formatDate(dateString) {
    if (!dateString) return '';
    
    // Convert to Date object if it's not already
    if (!(dateString instanceof Date)) {
        dateString = new Date(dateString);
    }
    
    // Get date components
    const day = dateString.getDate().toString().padStart(2, '0');
    const month = (dateString.getMonth() + 1).toString().padStart(2, '0');
    const year = dateString.getFullYear();
    
    return `${day}-${month}-${year}`;
}
