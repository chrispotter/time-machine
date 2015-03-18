timemachine = {
    cookieName: "blueacorn_timemachine",
    selector: "#datepicker",
    picker: null,
    init: function(selector) {
        if(selector) this.selector = selector;
        this.picker = $j(this.selector);
        this.picker.datepicker({
            changeMonth: true,
            changeYear: true
        });
        this.picker.datepicker("setDate", timemachine.getValue());
        this.picker.datepicker( "refresh" );
    },
    update: function()
    {
        var date = this.picker.datepicker("getDate")
        document.cookie=this.cookieName+"="+date+"; path=/";
        location.reload();
    },

    getValue: function()
    {
        var re = new RegExp(this.cookieName + "=([^;]+)");
        var value = re.exec(document.cookie);
        var returnable = (value != null) ? unescape(value[1]) : null;

        var date = (returnable != null) ? new Date( returnable) : new Date();

        return (date.getMonth()+1)+'/'+date.getDate()+'/'+date.getFullYear();
    },

    reset: function()
    {
        this.picker.datepicker("setDate", '');
        var cookie_date = new Date ( );  // now
        cookie_date.setTime ( cookie_date.getTime() - 1 );
        document.cookie = this.cookieName+"="+cookie_date.toUTCString()+"; expires=" + cookie_date.toUTCString();
        location.reload();
    }
};