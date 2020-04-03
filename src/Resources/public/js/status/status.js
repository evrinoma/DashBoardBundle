import '../../css/status/status.css';
import DashBoardEvents from "./events";

export default class DashBoard extends DashBoardEvents {
    constructor() {
        super();
        this.interval = 5000;
        this.init();
    }

    getStatus(self) {
        let dashboard = $('#dashboard');
        self.beforeUpdate();
        $.ajax({
            url: self.getUrl('dashboard_status'),
            type: 'GET',
            success: function (html) {
                let div = $('<div/>').html(html).contents();
                let insert = div.filter('#dashboard');
                if (!insert.length) {
                    insert = div.find('#dashboard');
                }
                dashboard.html(insert);

                self.afterUpdate();
            }
        });
    }

    init() {
        setInterval(this.getStatus, this.interval, this);
    }
}
