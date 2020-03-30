import { Component, Input, OnInit, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'star-rating',
  templateUrl: 'star-rating.component.html',
  styleUrls: ['star-rating.component.scss']
})
export class StarRatingComponent implements OnInit {

  @Input() rating: number;

  constructor() {
    this.Math = Math;
    this.parseFloat = parseFloat;
  }
  @Output() ratingChanged: EventEmitter<number> = new EventEmitter<number>();

  @Input() readonly = 'false';
  @Input() activeColor = '#488aff';
  @Input() defaultColor = '#aaaaaa';
  @Input() activeIcon = 'star';
  @Input() defaultIcon = 'star-outline';
  @Input() halfIcon = 'star-half';
  @Input() halfStar = 'false';
  @Input() maxRating = 5;
  @Input() fontSize = '28px';
  Math: any;
  parseFloat: any;
  iconsArray: number[] = [];

  ngOnInit(): void {
    for (let i = 0; i < this.maxRating; i++) {
      this.iconsArray.push(i);
    }
  }

  changeRating(id) {
    if (this.readonly && this.readonly === 'true') { return; }
    if (this.halfStar && this.halfStar === 'true') {
      this.rating = ((this.rating - id > 0) && (this.rating - id <= 0.5)) ? id + 1 : id + .5;
    } else {
      this.rating = id + 1;
    }
    this.ratingChanged.emit(this.rating);
  }
}
