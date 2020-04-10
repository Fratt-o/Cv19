import { Component, Input } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { AccessPage } from '../../../authentication/access/access.page';
import {AuthService} from '../../../services/auth.service';
import { PopoverController } from '@ionic/angular';
import {PopoverComponent} from '../popover/popover.component';
import { FormGroup, PatternValidator } from '@angular/forms';
import { ValidationPatterns } from 'src/app/models/enumerations/patterns';



const ErrorsDict = {
    required: 'Campo obbligatorio',
    maxlength: 'Superata lunghezza massima',
    minlength: 'Lunghezza del testo troppo breve',
    email: 'Email non valida',
    password: 'La password deve avere almeno un carattere minuscolo, maiuscolo, un numero ed una lunghezza minima di 8 caratteri',
    username: 'L\'username può contenere solo caratteri e numeri e deve avere una lunghezza minima di 3',
    nameString: 'Testo non valido',
    pattern: '',
    min: 'Devi selezionare almeno una stella'
};

@Component({
  selector: 'error-validation-msg',
  template: `<div *ngIf="hasError()">
     <div class="error" *ngFor="let error of buildErrorsArray()">
         {{error}}
     </div>
</div>`,
  styles: [`
    .error{
        font-size: .8em;
        color: #eb445a;
    }
  `],
})
export class ErrorValidationComponent  {
  @Input() form: FormGroup;
  @Input() field: string;
  @Input() errorMsg: string;
  @Input() avoidTouched: boolean = false;
  constructor() { }

  hasError() {
      const field = this.form && this.form.get(this.field);
      if(!field) {
          return false;
      }
      if(!this.avoidTouched) {
          return field.errors && (field.touched || !field.pristine);
      } else {
          return field.errors;
      }
  }

  buildErrorsArray() {
      if(this.hasError()) {
        const errors = this.form.get(this.field).errors;
        const errorsArray = [];
        Object.keys(errors).forEach(k =>{
            if(k === 'pattern') {
                if(errors[k].requiredPattern === ValidationPatterns.email) {
                    errorsArray.push(ErrorsDict['nameString']);
                } else if(errors[k].requiredPattern === ValidationPatterns.email) {
                    errorsArray.push(ErrorsDict['email']);
                } else if(errors[k].requiredPattern === ValidationPatterns.password) {
                    errorsArray.push(ErrorsDict['password']);
                } else if(errors[k].requiredPattern === ValidationPatterns.username) {
                    errorsArray.push(ErrorsDict['username']);
                } else {
                    errorsArray.push(ErrorsDict[k]);
                }
            } else {
                errorsArray.push(ErrorsDict[k]);
            }
        });
        return errorsArray;
      } else {
          return [];
      }
  }
}







