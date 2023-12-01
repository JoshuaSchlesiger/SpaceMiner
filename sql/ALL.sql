
INSERT INTO `stations` (`id`, `name`) VALUES
(1, 'ARC-L1'),
(2, 'ARC-L2'),
(3, 'ARC-L4'),
(4, 'CRU-1'),
(5, 'HUR-L1'),
(6, 'HUR-L2'),
(7, 'MIC-L1'),
(8, 'MIC-L2'),
(9, 'MIC-L5');


INSERT INTO `ores` (`id`, `name`, `rawValue`, `refinedValue`) VALUES
(1, 'Quantainium', 10117.00, 24557.00),
(2, 'Gold',       2851.00, 7534.00),
(3, 'Taranite',   3117.00, 7839.00),
(4, 'Bexalite',   3079.00, 7981.00),
(5, 'Diamond',    368.00, 4302.00),
(6, 'Borase',     1351.00, 3544.00),
(7, 'Laranite',   1172.00, 2925.00),
(8, 'Agricium',   1035.00, 2688.00),
(9, 'Hephaestanite', 1122.00, 2828.00),
(10, 'Beryl',     1148.00, 2815.00),
(11, 'Titan',     184.00, 506.00),
(12, 'Quartz',    159.00, 415.00),
(13, 'Copper',    145.00, 407.00),
(14, 'Iron',      0.00, 406.00),
(15, 'Tungsten',  163.00, 430.00),
(16, 'Corundum',  157.00, 388.00),
(17, 'Aluminum',  125.00, 337.00),
(18, 'Inert',     0.00, 0.00);


INSERT INTO `methods` (`id`, `name`, `factorYield`, `factorCosts`, `factorTime`) VALUES
(1, 'Cormack', 0.665, 4, 0.016),
(2, 'Dinyx Solvention', 0.95, 2, 0.8),
(3, 'Electrostarolysis', 0.808, 4, 0.066),
(4, 'Ferron Exchange', 0.95, 4, 0.266),
(5, 'Gaskin Process', 0.808, 12, 0.033),
(6, 'Kazen Winnowing', 0.665, 2, 0.05),
(7, 'Pyrometric Chromalysis', 0.95, 12, 0.133),
(8, 'Thermonatic Deposition', 0.808, 2, 0.2),
(9, 'XCR Reaction', 0.665, 12, 0.008);

INSERT INTO refinements (ore_id, station_id, factorTime, factorCosts, factorYield) VALUES 
(1, 1, 107, 104, 103),
(1, 2, 107, 104, 103), 
(1, 3, 91, 107, 100), 
(1, 4, 98, 98, 100), 
(1, 5, 100, 104, 102), 
(1, 6, 100, 104, 102), 
(1, 7, 98, 97, 100), 
(1, 8, 98, 97, 101), 
(1, 9, 200, 200, 100), 
(2, 1, 200, 200, 100), 
(2, 2, 104, 90, 102), 
(2, 3, 200, 200, 100), 
(2, 4, 97, 95, 94), 
(2, 5, 94, 104, 98), 
(2, 6, 200, 200, 100), 
(2, 7, 200, 200, 100), 
(2, 8, 119, 104, 109), 
(2, 9, 120, 107, 112), 
(3, 1, 81, 102, 94), 
(3, 2, 200, 200, 100), 
(3, 3, 90, 105, 105), 
(3, 4, 200, 200, 100), 
(3, 5, 200, 200, 100), 
(3, 6, 90, 104, 97), 
(3, 7, 118, 97, 100), 
(3, 8, 200, 200, 100), 
(3, 9, 200, 200, 100), 
(4, 1, 200, 200, 100),
(4, 2, 109, 94, 107), 
(4, 3, 91, 100, 96), 
(4, 4, 94, 93, 94), 
(4, 5, 91, 105, 97), 
(4, 6, 97, 109, 101), 
(4, 7, 100, 95, 101), 
(4, 8, 111, 96, 109), 
(4, 9, 200, 200, 100), 
(5, 1, 100, 100, 100), 
(5, 2, 100, 100, 100), 
(5, 3, 100, 100, 100), 
(5, 4, 100, 100, 100), 
(5, 5, 100, 100, 100), 
(5, 6, 100, 100, 100), 
(5, 7, 100, 100, 100), 
(5, 8, 100, 100, 100), 
(5, 9, 100, 100, 100), 
(6, 1, 200, 200, 100), 
(6, 2, 98, 92, 102), 
(6, 3, 200, 200, 100), 
(6, 4, 200, 200, 100), 
(6, 5, 97, 105, 101), 
(6, 6, 100, 101, 100), 
(6, 7, 200, 200, 100), 
(6, 8, 95, 95, 197), 
(6, 9, 111, 105, 109), 
(7, 1, 92, 102, 98),
(7, 2, 200, 200, 100), 
(7, 3, 200, 200, 100), 
(7, 4, 107, 89, 92), 
(7, 5, 100, 104, 102), 
(7, 6, 91, 106, 99), 
(7, 7, 96, 94, 102), 
(7, 8, 102, 90, 99), 
(7, 9, 200, 200, 100), 
(8, 1, 81, 103, 96), 
(8, 2, 87, 85, 92), 
(8, 3, 79, 100, 95), 
(8, 4, 97, 97, 98), 
(8, 5, 200, 200, 100), 
(8, 6, 200, 200, 100), 
(8, 7, 200, 200, 100), 
(8, 8, 200, 200, 100), 
(8, 9, 109, 106, 108), 
(9, 1, 105, 104, 107), 
(9, 2, 200, 200, 100), 
(9, 3, 88, 98, 96), 
(9, 4, 109, 200, 107), 
(9, 5, 200, 102, 100), 
(9, 6, 100, 109, 101), 
(9, 7, 83, 95, 94), 
(9, 8, 90, 92, 92), 
(9, 9, 104, 200, 107), 
(10, 1, 200, 200, 100), 
(10, 2, 200, 200, 100), 
(10, 3, 85, 100, 96), 
(10, 4, 200, 200, 100), 
(10, 5, 88, 103, 92), 
(10, 6, 105, 98, 98), 
(10, 7, 105, 96, 108), 
(10, 8, 200, 200, 100), 
(10, 9, 200, 200, 100), 
(11, 1, 111, 97, 105), 
(11, 2, 107, 94, 103), 
(11, 3, 86, 100, 98), 
(11, 4, 95, 96, 99), 
(11, 5, 200, 200, 100), 
(11, 6, 200, 200, 100), 
(11, 7, 200, 200, 100), 
(11, 8, 105, 91, 106), 
(11, 9, 112, 106, 113), 
(12, 1, 200, 200, 100), 
(12, 2, 84, 98, 94), 
(12, 3, 89, 100, 95), 
(12, 4, 108, 97, 102), 
(12, 5, 101, 104, 104), 
(12, 6, 102, 102, 100), 
(12, 7, 200, 200, 100), 
(12, 8, 110, 97, 109), 
(12, 9, 200, 200, 100), 
(13, 1, 109, 110, 111), 
(13, 2, 200, 200, 100), 
(13, 3, 77, 100, 98), 
(13, 4, 200, 200, 100), 
(13, 5, 97, 103, 100), 
(13, 6, 100, 103, 100), 
(13, 7, 91, 95, 97), 
(13, 8, 89, 92, 95), 
(13, 9, 200, 200, 100), 
(14, 1, 200, 200, 100), 
(14, 2, 104, 98, 106), 
(14, 3, 89, 100, 96), 
(14, 4, 96, 97, 100), 
(14, 5, 93, 105, 95), 
(14, 6, 99, 105, 97), 
(14, 7, 99, 98, 104), 
(14, 8, 97, 91, 102), 
(14, 9, 107, 102, 109), 
(15, 1, 97, 98, 101), 
(15, 2, 200, 200, 100), 
(15, 3, 200, 200, 100), 
(15, 4, 108, 97, 102), 
(15, 5, 96, 105, 95), 
(15, 6, 97, 103, 100), 
(15, 7, 100, 92, 100), 
(15, 8, 200, 200, 100), 
(15, 9, 103, 103, 108), 
(16, 1, 92, 103, 96),
(16, 2, 86, 93, 97), 
(16, 3, 79, 100, 91), 
(16, 4, 108, 97, 107), 
(16, 5, 93, 103, 95), 
(16, 6, 102, 103, 101), 
(16, 7, 96, 97, 102), 
(16, 8, 108, 91, 106), 
(16, 9, 200, 200, 100), 
(17, 1, 87, 105, 95),
(17, 2, 91, 103, 100), 
(17, 3, 91, 100, 97), 
(17, 4, 104, 97, 100), 
(17, 5, 96, 105, 96), 
(17, 6, 200, 200, 100), 
(17, 7, 115, 96, 107), 
(17, 8, 200, 200, 100), 
(17, 9, 200, 200, 100);

--
-- Daten für Tabelle `selling_stations`
--

INSERT INTO `selling_stations` (`id`, `name`) VALUES
(1, 'Orison'),
(2, 'Lorville'),
(3, 'MicroTech'),
(4, 'Area18');



