import { Injectable } from '@angular/core';
import { Plugins, CameraResultType, Capacitor, FilesystemDirectory, 
  CameraPhoto, CameraSource } from '@capacitor/core';
// import { ImagePicker } from '@ionic-native/image-picker/ngx';
const { Camera, Filesystem, Storage } = Plugins

@Injectable({
  providedIn: 'root'
})
export class PhotoService {

  constructor() { }

  public async takePhoto() {
    // Take a photo
    const capturedPhoto = await Camera.getPhoto({
      resultType: CameraResultType.Uri, 
      source: CameraSource.Camera, 
      quality: 100 
    });

    return capturedPhoto;
  }


 /* async pickFromGallery() {
    const options = {
      maximumImagesCount: 1,
      outputType: 0 // window.imagePicker.OutputType.FILE_URI
    };
    const selectedPhotos = await this.imagePicker.getPictures(options);
    return selectedPhotos[0];
  }*/

  async pickFromGallery() {
    const capturedPhoto = await Camera.getPhoto({
      resultType: CameraResultType.Uri, 
      source: CameraSource.Prompt, 
      quality: 100 
    });

    return capturedPhoto;
  }

  public async toBase64(blobUrl: string): Promise<any> {
    let blob = await fetch(blobUrl).then(r => r.blob());
    return new Promise((resolve, reject) => {
      var reader = new FileReader();
      reader.readAsDataURL(blob); 
      reader.onloadend = function() {
        resolve(reader.result);     
      }
    });
  }
}
