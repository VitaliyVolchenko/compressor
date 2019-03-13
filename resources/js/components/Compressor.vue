<template>
    <div>
        <div class="row justify-content-center mb-5" style='margin-top: 50px; border-bottom: 1px solid #ccc;
        padding-bottom: 30px;'>
            <div class="col-md-6">                
              <form @submit.prevent="compress">
                <div class="form-group" style='color: red; display: flex;justify-content: center;'>
                  <p v-if="errors.length">
                    <b>Пожалуйста исправьте указанные ошибки:</b>
                    <ul>
                      <li v-for="error in errors">{{ error }}</li>
                    </ul>
                  </p>
                </div>
                <div class="form-group" style='display: flex;justify-content: space-between;'>
                    <label class='mb-0 font-weight-bold text-primary' style='width: 100%;
                    text-align: end;
                    margin-right: 20px;'>Input String</label>
                    <div  style='max-width: 284px !important; width: 100%'>
                        <input type="text" class="form-control inp" placeholder="Enter"
                        v-model="stringToCompress">
                    </div>                    
                </div>
                <div class="form-group" style='display: flex;justify-content: space-between;'>
                    <label style='width: 100%;
                    text-align: end;
                    margin-right: 20px;' class='mb-0 font-weight-bold text-primary'>Compressed String</label>
                    <div  style='max-width: 284px !important; width: 100%'>
                        <input  type="text" class="form-control inp" :value="resCompress" >
                        <div style="justify-content: flex-start;
                        display: flex;" class="mt-3">
                            <button type="submit" class="btn btn-primary mr-3 submit">Submit</button>
                            <button type="button" v-on:click="clear" class="btn btn-danger clear">Clear</button>
                        </div>
                    </div>
                </div>
              </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form @submit.prevent="decompress">
                  <div class="form-group" style='color: red; display: flex;justify-content: center;'>
                    <p v-if="errorsDec.length">
                      <b>Пожалуйста исправьте указанные ошибки:</b>
                      <ul>
                        <li v-for="error in errorsDec">{{ error }}</li>
                      </ul>
                    </p>
                  </div>
                  <div class="form-group" style='display: flex;justify-content: space-between;'>
                      <label class='mb-0 font-weight-bold text-primary' style='width: 100%;
                      text-align: end;
                      margin-right: 20px;'>Input String</label>
                      <div  style='max-width: 284px !important; width: 100%'>
                          <input type="text" class="form-control inp" v-model="stringToDecompress" placeholder="Enter">
                      </div>                        
                  </div>
                  <div class="form-group" style='display: flex;justify-content: space-between;'>
                      <label style='width: 100%;
                      text-align: end;
                      margin-right: 20px;' class='mb-0 font-weight-bold text-primary' >Decompressed String</label>
                      <div  style='max-width: 284px !important; width: 100%'>
                          <input  type="text" class="form-control inp" :value="resDecompress" >
                          <div style="justify-content: flex-start;
                          display: flex;" class="mt-3">
                              <button type="submit" class="btn btn-primary mr-3">Submit</button>
                              <button type="button" v-on:click="clearDecompress" class="btn btn-danger">Clear</button>
                          </div>
                      </div>
                  </div>
                </form>
            </div>
        </div>
    </div>    
</template>

<script>
import axios from 'axios';
//@click="compress"

export default {
    data() {
        return {
          errors: [],
          errorsDec: [],
          stringToCompress: '',
          stringToDecompress: '',
          resCompress: '',
          resDecompress: ''                     
        }
    },

    methods: {

      validStringToCompress(string) {
        var re = "/[a-f]\S^\d]+*/";
        return re.test(string);
      },

      validStringToDecompress(string) {
        var re = "/[a-f]\S]+*/";
        return re.test(string);
      },
        
      compress() {

        this.errors = [];

        if (!this.stringToCompress){
          this.errors.push('string required.');          
        }

        if(!this.validStringToCompress(this.stringToCompress)){
          this.errors.push('Valid string required.');
        }

        if(this.errors.length<1){               

          console.log('COMPRESS', this.stringToCompress);        
          axios.post('api/compress', {stringToCompress: this.stringToCompress})
          .then(res => {
            console.log(res.data)
            this.resCompress = res.data;
          })
          .catch((err) => {
              console.log(err);
          });

        }
      },
      clear() {
          console.log('CLEAR');
          this.stringToCompress = '';
          this.resCompress = '';
      },
      decompress() {
        this.errorsDec = [];

        if (!this.stringToDecompress){
          this.errorsDec.push('string required.');          
        }

        if(!this.validStringToDecompress(this.stringToDecompress)){
          this.errorsDec.push('Valid string required.');
        }

        if(this.errorsDec.length<1) {
          console.log('DECOMPRESS', this.stringToDecompress);        
          axios.post('api/decompress', {stringToDecompress: this.stringToDecompress})
          .then(res => {
            console.log(res.data)
            this.resDecompress = res.data;
          })
          .catch((err) => {
              console.log(err);
            });
        }
      },
      clearDecompress() {
          console.log('CLEAR_DECOMPRESS');
          this.stringToDecompress = '';
          this.resDecompress = '';
      }
        
    }
}
</script>

