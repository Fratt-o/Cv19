import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {StarRatingComponent} from './component/star-rating/star-rating.component';
import {IonicModule} from '@ionic/angular';



@NgModule({
  declarations: [StarRatingComponent],
  exports: [StarRatingComponent],
  imports: [
    CommonModule,
    IonicModule.forRoot()
  ]
})
export class SharedModule { }
