class StreamUtilities{
    constructor(){
        
    }

deleteStatus(statusToBeDeleted){
    if ( confirm("Are you sure you want to delete")){
        this.form.delete('delete-status/'+statusToBeDeleted).then(response=>this.statusDeleted(response))
    }
}
statusLiked(id){
   return axios.post('like-status/'+id).then(this.getStatus())
}
getStatus(){
    return  axios.get('/get-statuses').then(response=>(this.prepareStatus(response.data.data)))
}
}
export default StreamUtilities;