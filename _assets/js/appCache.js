$(function() {
    var appCache = window.applicationCache;
    if (appCache.status == window.applicationCache.UPDATEREADY) {
        appCache.swapCache();  // The fetch was successful, swap in the new cache.
    }
});