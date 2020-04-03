export default class DashBoardEvents {

    constructor() {
        this.url = {'dashboard_status': location.protocol + '//' + location.hostname + '/evrinoma/dashboard/status'};
    }

    getUrl(alias) {
        let url = '';
        if (this.url["dashboard_status"] !== undefined) {
            url = this.url[alias];
        }
        return url;
    }

    beforeUpdate() {
        console.log('beforeUpdate DashBoardEvents');
    }

    afterUpdate() {
        console.log('afterUpdate DashBoardEvents');
    }
}
