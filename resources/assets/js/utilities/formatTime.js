import moment from "moment";

class FormatTime{

formatTimeAgo(date){
    var differencesInTime = this.getTimeDifferences(date)
    return this.formatTimeText(differencesInTime, date)
}

getTimeDifferences(date){
    var created_at = moment(date).format()
    var timeNow = moment().format()
    var createdInSeconds = moment(created_at);
    var nowInSeconds = moment(timeNow);
    var differencesInTime= nowInSeconds.diff(createdInSeconds, 'seconds')
    return differencesInTime - 3600
}

formatTimeText(differencesInTime, date){
    if(differencesInTime <= 10){
        return "few seconds ago"
    }
    else if(differencesInTime <= 59){
        return "about a minutes ago"
    }
    else if(differencesInTime <= 600 ){
        return "few minutes ago"
    }
    else if(differencesInTime <= 2000 ){
        return "less than an hour ago"
    }
    else if(differencesInTime >= 3600 ){
        return moment(date).startOf('minutes').fromNow(); 
    }
}
}
export default FormatTime;