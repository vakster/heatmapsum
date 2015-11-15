function initialize() {
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
      heatmap: { enabled: true },
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
    // Update the query sent to the Fusion Table Layer based on
      // the user selection in the select menu
      function updateMap(layer, tableId, locationColumn) {
        var delivery = document.getElementById('delivery').value;
        if (delivery) {
          layer.setOptions({
            query: {
              select: locationColumn,
              from: tableId,
              where: "delivery = '" + delivery + "'"
            }
          });
        } else {
          layer.setOptions({
            query: {
              select: locationColumn,
              from: tableId
            }
          });
  }

  google.maps.event.addDomListener(window, 'load', initialize);
