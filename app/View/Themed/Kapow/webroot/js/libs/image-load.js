(function($){"use strict";var loadImage=function(file,callback,options){var url,oUrl,img=document.createElement("img");return img.onerror=callback,img.onload=function(){!oUrl||options&&options.noRevoke||loadImage.revokeObjectURL(oUrl),callback(loadImage.scale(img,options))},window.Blob&&file instanceof Blob||window.File&&file instanceof File?(url=oUrl=loadImage.createObjectURL(file),img._type=file.type):"string"==typeof file&&(url=file),url?(img.src=url,img):loadImage.readFile(file,function(e){var target=e.target;target&&target.result?img.src=target.result:callback(e)})},urlAPI=window.createObjectURL&&window||window.URL&&URL.revokeObjectURL&&URL||window.webkitURL&&webkitURL;loadImage.detectSubsampling=function(img){var canvas,ctx,iw=img.width,ih=img.height;return iw*ih>1048576?(canvas=document.createElement("canvas"),canvas.width=canvas.height=1,ctx=canvas.getContext("2d"),ctx.drawImage(img,-iw+1,0),0===ctx.getImageData(0,0,1,1).data[3]):!1},loadImage.detectVerticalSquash=function(img,ih){var data,sy,ey,py,alpha,canvas=document.createElement("canvas"),ctx=canvas.getContext("2d");for(canvas.width=1,canvas.height=ih,ctx.drawImage(img,0,0),data=ctx.getImageData(0,0,1,ih).data,sy=0,ey=ih,py=ih;py>sy;)alpha=data[4*(py-1)+3],0===alpha?ey=py:sy=py,py=ey+sy>>1;return py/ih||1},loadImage.renderImageToCanvas=function(img,canvas,width,height){var vertSquashRatio,tmpCtx,dw,dh,dx,dy,sx,sy,iw=img.width,ih=img.height,ctx=canvas.getContext("2d"),d=1024,tmpCanvas=document.createElement("canvas");for(ctx.save(),loadImage.detectSubsampling(img)&&(iw/=2,ih/=2),vertSquashRatio=loadImage.detectVerticalSquash(img,ih),tmpCanvas.width=tmpCanvas.height=d,tmpCtx=tmpCanvas.getContext("2d"),dw=Math.ceil(d*width/iw),dh=Math.ceil(d*height/ih/vertSquashRatio),dy=0,sy=0;ih>sy;){for(dx=0,sx=0;iw>sx;)tmpCtx.clearRect(0,0,d,d),tmpCtx.drawImage(img,-sx,-sy),ctx.drawImage(tmpCanvas,0,0,d,d,dx,dy,dw,dh),sx+=d,dx+=dw;sy+=d,dy+=dh}ctx.restore(),tmpCanvas=tmpCtx=null},loadImage.scale=function(img,options){options=options||{};var canvas=document.createElement("canvas"),width=img.width,height=img.height,scale=Math.max((options.minWidth||width)/width,(options.minHeight||height)/height);return scale>1&&(width=Math.ceil(width*scale),height=Math.ceil(height*scale)),scale=Math.min((options.maxWidth||width)/width,(options.maxHeight||height)/height),1>scale&&(width=Math.ceil(width*scale),height=Math.ceil(height*scale)),img.getContext||options.canvas&&canvas.getContext?(canvas.width=width,canvas.height=height,"image/jpeg"===img._type?loadImage.renderImageToCanvas(img,canvas,width,height):canvas.getContext("2d").drawImage(img,0,0,width,height),canvas):(img.width=width,img.height=height,img)},loadImage.createObjectURL=function(file){return urlAPI?urlAPI.createObjectURL(file):!1},loadImage.revokeObjectURL=function(url){return urlAPI?urlAPI.revokeObjectURL(url):!1},loadImage.readFile=function(file,callback){if(window.FileReader&&FileReader.prototype.readAsDataURL){var fileReader=new FileReader;return fileReader.onload=fileReader.onerror=callback,fileReader.readAsDataURL(file),fileReader}return!1},"function"==typeof define&&define.amd?define(function(){return loadImage}):$.loadImage=loadImage})(this);