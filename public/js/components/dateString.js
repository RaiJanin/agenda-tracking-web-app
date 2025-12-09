export function dateToString(options, dateString) {
    const dateStamp = new Date(dateString);
    switch (options) {
        case 'longDate':
            return dateStamp.toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric',
            });

        case 'shortDate':
            return dateStamp.toLocaleDateString('en-Us', {
                month: 'short',
                day: 'numeric',
                year: 'numeric',
            });

        case 'iso':
            return dateStamp.toISOString().split('T')[0];

        case 'timeOnly24':
            return dateStamp.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            });
        
        case 'timeOnly12':
            return dateStamp.toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });

        default:
            return dateStamp.toLocaleDateString();
    }
}