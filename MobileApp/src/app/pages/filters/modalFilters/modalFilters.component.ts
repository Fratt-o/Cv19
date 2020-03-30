import {Component, EventEmitter, Output} from '@angular/core';
import { ModalController } from '@ionic/angular';
import { FiltersComponent } from '../filters.component';
import {FilterModel} from '../../../models/interfaces/filtermodel';

@Component({
  selector: 'modalFilters',
  templateUrl: './modalFilters.component.html',
  styleUrls: ['./modalFilters.component.scss'],
})
export class ModalFiltersComponent  {
  @Output() confirm: EventEmitter<FilterModel> = new EventEmitter<FilterModel>();
  constructor(public modalCtrl: ModalController) { }
  async showModal() {
    const modal = await this.modalCtrl.create({
      component: FiltersComponent,
      backdropDismiss: true,
      cssClass: 'login-authentication',
      animated: true,
      showBackdrop: true
    });

    modal.onWillDismiss().then((res) => {
      if (res && res.data && res.data.confirmed) {
        this.confirm.emit(res.data.filterModel);
      }
    });

    return await modal.present();
    }
  }



