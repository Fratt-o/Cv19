import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {StarRatingComponent} from './component/star-rating/star-rating.component';
import {IonicModule} from '@ionic/angular';
import { ErrorValidationComponent } from './component/error-validation-msg/error-validation-msg.component';



@NgModule({
  declarations: [StarRatingComponent, ErrorValidationComponent],
  exports: [StarRatingComponent, ErrorValidationComponent],
  imports: [
    CommonModule,
    IonicModule.forRoot()
  ]
})
export class SharedModule { }
