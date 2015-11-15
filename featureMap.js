function initialize() {
    var tableId = '1KHOXHQWl11dYJmHTRzdksJBu3LiRQ7g5Yt0UtM_q';
    var locationColumn = 'col4';
    
    google.maps.visualRefresh = true;
    var isMobile = (navigator.userAgent.toLowerCase().indexOf('android') > -1) ||
      (navigator.userAgent.match(/(iPod|iPhone|iPad|BlackBerry|Windows Phone|iemobile)/));
    if (isMobile) {
      var viewport = document.querySelector("meta[name=viewport]");
      viewport.setAttribute('content', 'initial-scale=1.0, user-scalable=no');
    }
    var mapDiv = document.getElementById('googft-mapCanvas');
    mapDiv.style.width = isMobile ? '100%' : '800px';
    mapDiv.style.height = isMobile ? '100%' : '500px';
    var map = new google.maps.Map(mapDiv, {
      center: new google.maps.LatLng(46.768862265500054, -112.58358379999999),
      zoom: 3,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    layer = new google.maps.FusionTablesLayer({
      map: map,
      heatmap: { enabled: false },
      query: {
        select: "col4",
        from: "1KHOXHQWl11dYJmHTRzdksJBu3LiRQ7g5Yt0UtM_q",
        where: ""
      },
      options: {
        styleId: 3,
        templateId: 4
      }
    });
    if (isMobile) {
      var legend = document.getElementById('googft-legend');
      var legendOpenButton = document.getElementById('googft-legend-open');
      var legendCloseButton = document.getElementById('googft-legend-close');
      legend.style.display = 'none';
      legendOpenButton.style.display = 'block';
      legendCloseButton.style.display = 'block';
      legendOpenButton.onclick = function() {
        legend.style.display = 'block';
        legendOpenButton.style.display = 'none';
      }
      legendCloseButton.onclick = function() {
        legend.style.display = 'none';
        legendOpenButton.style.display = 'block';
      }
    }
    
google.maps.event.addDomListener(document.getElementById('heatmap'),
            'click', function() {
              var heatmap = document.getElementById('heatmap');
              layer.setOptions({
                heatmap: {
                  enabled: heatmap.checked
                }
                radius:{50}
              });
        });
        
        
        function updateMap(layer, tableId, locationColumn) {
        var heatmap = document.getElementById('heatmap').value;
        if (heatmap) {
          layer.setOptions({
            query: {
              select: locationColumn,
              from: tableId,
              where: ""
            }
          });
        } else {
          layer.setOptions({
            query: {
              select: 'col1',
              from: tableId
            }
          });
        }
        }

}
  google.maps.event.addDomListener(window, 'load', initialize);
