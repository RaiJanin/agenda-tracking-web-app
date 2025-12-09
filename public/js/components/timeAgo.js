export function timeAgo(dateString) {
    const now = new Date();
    const past = new Date(dateString);
    const seconds = Math.floor((now - past) / 1000);
    const daySeconds = 86400;

    if (seconds > 5 * daySeconds) {
        return past.toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric'
        });
    }

    const intervals = {
        day: 86400,
        hour: 3600,
        minute: 60
    };

    for (const key in intervals) {
        const interval = Math.floor(seconds / intervals[key]);
        if (interval >= 1) {
            return `${interval} ${key}${interval > 1 ? 's' : ''} ago`;
        }
    }
    return "just now";
}
