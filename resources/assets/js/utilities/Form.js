import Errors from './Errors';
class Form{
    constructor(data){
        this.originalData = data;
        
        for (let field in data){
            this[field] = data[field];
        }

        this.errors = new Errors();
    }
    
    data(){
        let data = {};

        for(let property in this.originalData){
            data[property] = this[property];
        }        

        return data;
    }

    submit(requestType, url){
            return new Promise((resolve, reject)=>{

                axios[requestType](url, this.data())
                .then(response=> {
                    this.onSuccess(response.data);

                    resolve(response.data);
                })

                .catch(error=>{
                    this.onFail(error.response.data.errors);
              
                    reject(error.response.data);

                /* .catch(error=>this.errors.record(error.response.data.errors)); */

            });
        });

    }
    post(url){
        return this.submit('post', url)

    }
    delete(url){
        return this.submit('delete', url)
    }
    patch(url){
        return this.submit('patch', url)
    }
    
    submitting(){
        alert('Your form is being created...')
    }
    
    onSuccess(data){
        this.reset();
    }
    
    onFail(errors){
        this.errors.record(errors)
    }

    reset(){
        for (let field in this.originalData){
            this[field] = '';
        }
        this.errors.clear();
    }
}
export default Form;