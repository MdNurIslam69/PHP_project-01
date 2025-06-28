-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 28, 2025 at 07:49 PM
-- Server version: 9.3.0
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imran_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact-us_form`
--

CREATE TABLE `contact-us_form` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int NOT NULL,
  `message` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact-us_form`
--

INSERT INTO `contact-us_form` (`id`, `name`, `email`, `phone`, `message`, `create_at`) VALUES
(1, 'Md Nur Islam', 'rose2025@gmail.com', 1828426031, 'This is a Test Message for checking the contact-us form setup', '2025-06-26 23:38:42'),
(14, 'Imran', 'rose2025@gmail.com', 1828426031, 'This is The 2nd Message, For Checking', '2025-06-27 12:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `total` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status` enum('Pending','Shifted','Success','Refunded','Cancel') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `phone_number`, `address`, `total`, `payment_method`, `status`, `created_at`) VALUES
(10, 1, 'Nurislam Imran', '01828426031', 'S.S.K Street, N104, Feni 3900', '7990', 'Cash_on_delivery', 'Pending', '2025-06-21 23:24:31'),
(11, 1, 'Nurislam Imran', '01828426031', 'Dhaka, Bangladesh', '15980', 'Cash_on_delivery', 'Shifted', '2025-06-23 06:59:01');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `total_amount`, `create_at`) VALUES
(10, 10, 39, 1, 7990, '2025-06-21 23:24:31'),
(11, 11, 52, 1, 14900, '2025-06-23 06:59:01'),
(12, 11, 6, 1, 1080, '2025-06-23 06:59:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `regular_price` int NOT NULL,
  `sales_price` int NOT NULL,
  `images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category_id` int NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `regular_price`, `sales_price`, `images`, `category_id`, `category_name`, `description`, `created_at`) VALUES
(1, 'Regular Fit Printed T-Shirt', 2250, 1195, '6854154591e7b5.38194559.webp', 1, 'T-shirt', 'Round neck T-shirt with chest printed in cotton single jersey knit fabrics.', '2025-06-19 13:48:53'),
(2, 'Gray Cotton Short-sleeved T-shirt', 1050, 891, '61Iyq-x6mOL._AC_SX569_.jpg', 1, 'T-shirt', 'Men’s printed t-shirt in cotton single jersey fabric. Crew neck, short sleeves.', '2025-06-19 14:57:05'),
(3, 'White Cotton Short-sleeved Round Neck T-shirt', 1050, 915, '68544c0726df32.88225251.jpg', 1, 'T-shirt', 'Men’s t-shirt in cotton single jersey fabric. Crew neck, short sleeves. Print on the chest.', '2025-06-19 17:42:31'),
(4, 'Black Cotton Short Sleeve Round Neck T-shirt', 1050, 950, '71G0ygXdgoL._AC_SL1500_.jpg', 1, 'T-shirt', 'Men’s t-shirt in cotton single jersey fabric. Crew neck, short sleeves. Print on the chest.', '2025-06-20 10:21:23'),
(5, 'Maroon Cotton Short Sleeve Round Neck', 1190, 990, '685537e36cf8c7.08197597.webp', 1, 'T-shirt', 'Men’s t-shirt in cotton single jersey fabric. Crew neck, short-sleeved, and typography at the front.', '2025-06-20 10:28:51'),
(6, 'Orange Striped Stretched Knit T-shirt', 1260, 1080, '685590a96a48f5.22231067.jpg', 1, 'T-shirt', 'Athleisures round neck T-shirt in stretchable mercerised knit fabric. Short sleeves.', '2025-06-20 16:47:37'),
(7, 'Mazenda Cotton Short Sleeve T-Shirt', 1020, 980, '685591d43344a1.42204022.jpg', 1, 'T-shirt', 'Men’s t-shirt in cotton single jersey fabric. Crew neck, short sleeves. Graphic print on the chest.', '2025-06-20 16:52:36'),
(8, 'Yellow Cotton Henley T-shirt', 1050, 891, '685592144af407.12054564.webp', 1, 'T-shirt', 'Men’s henley T-shirt in cotton jersey fabric. Henley neck with front button fastening and short sleeves.', '2025-06-20 16:53:40'),
(9, 'Ash Cotton Henley T-shirt', 1019, 999, '6855926d6aa613.00841591.jpg', 1, 'T-shirt', 'Men’s henley T-shirt in cotton single jersey fabric. Rounded scoop neckline with front button fastening and short sleeves.', '2025-06-20 16:55:09'),
(10, 'Teal Grey Cotton Knit Short Sleeve T-Shirt', 1150, 1050, '685592a31df023.35123537.webp', 1, 'T-shirt', 'Men’s t-shirt in stretched cotton knit fabric. Crew neck, short sleeves and typographic print on the front.', '2025-06-20 16:56:03'),
(11, 'Maroun Blue Slim Fit Jeans', 2250, 2080, '685594d3972ff3.52478637.jpg', 2, 'Pants', 'Men’s jeans in cotton spandex denim fabric. Seven pockets including two utility pockets in both sides, button fastening on the front and zipper fly.', '2025-06-20 17:05:23'),
(12, 'Richman Men’s Faded Black Color Denim Pant', 3250, 2990, '6855ac7251e567.86782546.jpg', 2, 'Pants', 'Slim-fit jeans. Five pockets. Faded effect. Zip fly and button fastening on the front', '2025-06-20 18:46:10'),
(13, 'Classic Black Slim Fit Denim by RICHAMN', 3250, 2990, '6855acb3618e39.94726551.jpg', 2, 'Pants', 'Slim-fit jeans. Five pockets. Faded effect. Zip fly and button fastening on the front', '2025-06-20 18:47:15'),
(14, 'Richman Men’s Dark Indigo Color Denim Pant', 3090, 2890, '6855ace7a6bb31.66957767.jpg', 2, 'Pants', 'Slim-fit jeans. Five pockets. Faded effect. Zip fly and button fastening on the front', '2025-06-20 18:48:07'),
(15, 'Richman Formal Men’s Black Color Denim Pant', 2690, 2520, '6855ad2db4fe90.91151748.webp', 2, 'Pants', 'Slim-fit formal. Five pockets. Faded effect. Zip fly and button fastening on the front', '2025-06-20 18:49:17'),
(16, 'Men’s Black color Denim Pant by Richman', 1720, 1590, '6855ad839885c5.64733040.jpg', 2, 'Pants', 'Slim-fit jeans. Five pockets. Faded effect. Zip fly and button fastening on the front', '2025-06-20 18:50:43'),
(17, 'Richman Sky Color Stripe Trouser', 2250, 2090, '6855b16c586fd8.27007872.webp', 2, 'Pants', 'Relaxed-fit trousers in twill made from a Cotton blend. Waistband with a concealed hook-and-eye fastener and a zip fly with a button. Diagonal side pockets, jetted back pockets and legs with creases.', '2025-06-20 19:07:24'),
(18, 'Richman Black wind Color Cargo Pant', 1650, 1490, '6855b2fad0f144.18842979.webp', 2, 'Pants', 'Classic Cargo trousers. Front pockets and jetted pockets on the back.', '2025-06-20 19:14:02'),
(19, 'Adventure Light Pants Men', 1790, 1550, '6855b3b6953fe3.70051524.webp', 2, 'Pants', 'Relaxed Fit: Designed to fit over a base layer as required.', '2025-06-20 19:17:10'),
(20, 'Winner Style Dark Blue Stylish Denim Pant', 1860, 1690, '6855b48fb9b7b4.71861806.jpg', 2, 'Pants', 'Winner Style Dark Blue Stylish Denim Pant for Men by Winner Style - WR19-Denim-56', '2025-06-20 19:20:47'),
(21, 'Stylish Premium Winter Jacket For Men', 4350, 4190, '6855bc87b8cea9.64802422.jpg', 3, 'Jacket', '✦ Stylish Casual Long Sleeve Jacket For Men\r\n✦ Fabric: 100% cotton\r\n✦ Fabrication: 350GSM\r\n✦ Size: M, L, XL', '2025-06-20 19:54:47'),
(22, 'MENS TRACKER JACKET', 3890, 3650, '6855bd2c18ad41.80889715.jpg', 3, 'Jacket', 'High-quality double-part winter biker hoodie jacket collection for men 2025', '2025-06-20 19:57:32'),
(23, 'Stylish Custom Design Winter Fashion Denim Jacket For Men', 4050, 3890, '6855bdab432b06.34148873.jpg', 3, 'Jacket', '✦ Type: Winter Jacket\r\n✦ Elegance and simplicity is the focus on design\r\n✦ Casual wear for men\r\n✦ Perfect for the winter season\r\n✦ Brand : Masculine\r\n✦ Main Material: Denim', '2025-06-20 19:59:39'),
(24, 'MENS KNIT JACKET', 4600, 4400, '6855bde3349ca0.96215222.jpg', 3, 'Jacket', 'Good Look Winter Collection Stylish Fashion Comfortable Denim Jacket For Men', '2025-06-20 20:00:35'),
(25, 'MENS RIDER PU JACKET', 3990, 3650, '6855be3ad431d6.52106261.jpeg', 3, 'Jacket', 'New Winter Collection Stylish Fashion Comfortable Denim Jacket For Men', '2025-06-20 20:02:02'),
(26, 'Mens Jacket | JK 3562', 5350, 4990, '6855be9e7a2641.72585734.webp', 3, 'Jacket', 'Stylish Custom Design Winter Fashion Denim Jacket For Men', '2025-06-20 20:03:42'),
(27, 'Mens Jacket | JK 3483', 4150, 3990, '6855bee6c840e0.67787319.webp', 3, 'Jacket', 'Classic Winter Collection Stylish Fashion Comfortable Denim Jacket For Men', '2025-06-20 20:04:54'),
(28, 'Mens Jacket | JK 3537', 4690, 4400, '6855bf1fb28cb0.93680406.webp', 3, 'Jacket', 'pavilion Winter Coat Keep Warm Thicken Kids Jacket Hooded Zipper Fur Collar Princess Outerwear Children&#039;s Clothing', '2025-06-20 20:05:51'),
(29, 'Mens Jacket | JK 3494', 3650, 3500, '6855bf5b326132.24362112.jpeg', 3, 'Jacket', 'Best Winter Collection Stylish Fashion Comfortable Denim Jacket For Men', '2025-06-20 20:06:51'),
(30, 'Mens Jacket | JK 3493', 4590, 4350, '6855bf95d9c7d4.43939427.jpg', 3, 'Jacket', 'Casual Vest Men Autumn Winter Jackets Thick Vests Men Sleeveless Coats Male Warm Cotton Padded Waistcoat (Size-,, m)Colour=Black', '2025-06-20 20:07:49'),
(31, 'Polo Classic Gabardine Blazer', 7500, 6890, '6855c0c8d0aa82.16575981.jpg', 4, 'Blazer', 'The Polo Classic, one of Polo’s newest tailored silhouettes, features a relaxed fit, natural shoulders, and pickstitched lapels. This version is crafted with wool-blend gabardine that was developed exclusively for Ralph Lauren.', '2025-06-20 20:12:56'),
(32, 'Richman Classic Blue Textured Slim Fit Blazer', 6500, 5800, '6855c20b5c6d63.03531913.jpg', 4, 'Blazer', 'Crafted from a lightweight and beautifully textured fabric, this is the perfect blazer for year-round wear. Mixed cotton fabric is a natural temperature regulator, so this adapts well.', '2025-06-20 20:18:19'),
(33, 'Premium Navy Color Slim Fit Blazer by RICHMAN', 9980, 8700, '6855c2510e38f2.29394369.jpg', 4, 'Blazer', 'The pronounced open texture of the hopsack weave adds interest to a classic piece that belongs in every gentleman’s closet. Wear this Blazer with a blue dress, black loafers.', '2025-06-20 20:19:29'),
(34, 'Premium Grey Color Slim Fit Blazer by RICHMAN', 6550, 6190, '6855c2a3eb8d18.52156937.jpg', 4, 'Blazer', 'Crafted from a lightweight and beautifully textured fabric, this is the perfect blazer for year-round wear. Mixed cotton fabric is a natural temperature regulator.', '2025-06-20 20:20:51'),
(35, 'Classic Navy Textured Formal Waistcoat', 7300, 6890, '6855c2f6017847.62242236.jpg', 4, 'Blazer', 'Reviving the traditional outfit in a classic Navy colour design for a timeless Waistcoat. Crafted from blended fabric, this luxurious fabric holds a naturally breathable and warm tactile texture.', '2025-06-20 20:22:14'),
(36, 'Premium Black Texture Slim Fit Blazer by RICHMAN', 8500, 7200, '6855c33ce28fc0.80476242.jpg', 4, 'Blazer', 'The pronounced open texture of the hopsack weave adds interest to a classic piece that belongs in every gentleman’s closet.', '2025-06-20 20:23:24'),
(37, 'Premium Desert Sand Colour Slim Fit Blazer by RICHMAN', 6890, 6250, '6855c37b839b40.67455634.jpg', 4, 'Blazer', 'Every aspect of our design process is focused on beauty, quality, and style, right down to the functional kissing sleeve buttons.', '2025-06-20 20:24:27'),
(38, 'Men’s Pink Color Slim-fit Blazer by Richman', 6200, 5990, '6855c3d278b999.42012450.jpg', 4, 'Blazer', 'Reviving the traditional outfit in a classic blue design for a timeless Blazer. Crafted from pure wool flannel, this luxurious Italian fabric', '2025-06-20 20:25:54'),
(39, 'Classic Red Plaid Blazer by RICHMAN', 8590, 7990, '6855c44c5c38a8.26886706.webp', 4, 'Blazer', 'Classic piece that belongs in every gentleman’s closet. Wear this Blazer with a blue dress, black loafers, and a sweater in a contrasting colour to create a sleek yet interesting look.', '2025-06-20 20:27:56'),
(40, 'Richman Classic Ash Textured Slim Fit Blazer', 5670, 5250, '6855c4accd33e8.71484009.webp', 4, 'Blazer', 'textured fabric, this is the perfect blazer for year-round wear. Mixed cotton fabric is a natural temperature regulator, so this adapts well to cold-weather layering and warm-weather tailored dressing alike.', '2025-06-20 20:29:32'),
(41, 'Stylish Casual Long Sleeve Hoodies For Men - Hudi For Men', 1750, 1590, '6855c739b00071.42561132.png', 5, 'Hudi', 'Product Type: Stylish Casual Long Sleeve Hoodies For Men Main Material: One side brush Type-Hoddie Comfortable Sleeve : Full sleeves GSM- 300-320 Made in Bangladesh A perfect casual wear Fit', '2025-06-20 20:40:25'),
(42, 'Red Hoodie - Stylish Winter Wear - Perfect Hudi for Men', 2150, 1990, '6855c7796a77f4.89676573.jpg', 5, 'Hudi', 'Product details of Black Hoodie - Stylish Winter Wear - Perfect Hudi for Men - Elevate Your Cold-Weather Look', '2025-06-20 20:41:29'),
(43, 'Stylish Woolen Sweater - Gift for Girls - White-Sweater', 1890, 1750, '6855c7c3b20325.00358516.jpeg', 5, 'Hudi', 'Comfort and Style: Women&#039;s hoodies are designed to offer both comfort and style, making them a versatile addition to any wardrobe.', '2025-06-20 20:42:43'),
(44, 'Cotton Winter Hoodie For men - Hudi', 1950, 1820, '6855c806812755.09905581.jpg', 5, 'Hudi', 'A hoodie is a cloth garment for the upper body, especially bought and worn during winter. Originally, hoodies are such a garment worn exclusively by men but it has become popular among women too.', '2025-06-20 20:43:50'),
(45, 'Hoodie STARWAGEN Oversize with rep tape White', 1890, 1750, '6855c8620dac97.03771476.jpg', 5, 'Hudi', 'It comes with a stylish head-cover, short or long sleeves, and an optional vertical opening (half or full) with buttons or zipper. To keep pace with trends and fashion.', '2025-06-20 20:45:22'),
(46, 'Custom Luxury Men&#039;s Hoodie Oversize Acid Washed Hoodie', 2380, 2150, '6855c8d4502a43.72123914.jpg', 5, 'Hudi', 'Men&#039;s Hoodie Oversize Acid Washed Hoodie Blank Pullover Streetwear Heavyweight Cropped Baggy Hoodies Hudi for Men', '2025-06-20 20:47:16'),
(47, 'Cotton Winter Hoodie For men - Hudi', 1890, 1750, '6855c94539aa76.03875304.webp', 5, 'Hudi', 'A cloth garment for the upper body, especially bought and worn during winter. Originally, hoodies were a garment worn exclusively by men  with a stylish head-cover,', '2025-06-20 20:49:09'),
(48, 'Winter Fashionable Hoodie for men', 2370, 2190, '6855c9ae790276.30034895.jpg', 5, 'Hudi', 'Hoodies, the Style of Trends!A hoodie is a cloth garment for the upper body, especially bought and worn during winter. Originally, hoodies were a garment worn exclusively', '2025-06-20 20:50:54'),
(49, 'Black And White Cotton Premium Quality WINTER Long Sleeve Hoodie For Men', 2190, 1980, '6855c9e6197d72.82582203.jpg', 5, 'Hudi', 'stylish head-cover, short or long sleeves, and an optional vertical opening (half or full) with buttons or zipper.', '2025-06-20 20:51:50'),
(50, 'Elevate Winter Style with Winter Cotton AR Black Long Sleeve Hoodie', 1890, 1750, '6855ca274f41f8.94627427.jpg', 5, 'Hudi', 'Introducing our Winter Cotton AR Black Long Sleeve Hoodie for Men, perfect for the colder months. Made with high-quality cotton, this hoodie is both comfortable and durable.', '2025-06-20 20:52:55'),
(51, 'Fossil Neutra Chronograph White Dial Men&#039;s Watch | FS6023', 11200, 10500, '6855cae47e1a54.12793265.jpg', 6, 'Watch', 'Fossil Neutra Chronograph White Dial Men&#039;s Watch | FS6023. Inspired by the balanced symmetry of modern architecture, the Fossil Neutra Chronograph FS6023 offers a blend of form and function with a timeless aesthetic.', '2025-06-20 20:56:04'),
(52, 'Fossil Everett Automatic Smoke Stainless Steel Men’s Watch | ME3206', 16500, 14900, '6855cb1dc2d9d7.07150312.jpg', 6, 'Watch', 'Brand: Fossil, Series: Everett, Gender: Men’s, Model: ME3206, Movement: Automatic, Case Size: 42mm, Case Thickness: 10mm, Case Thickness: 11mm, Dial Color: Grey, Case Material: Stainless Steel, Case Shape: Round', '2025-06-20 20:57:01'),
(53, 'Fossil Flynn Multifunction Blue Dial Men&#039;s Watch | BQ2219', 12000, 11200, '6855cb46750421.42908629.webp', 6, 'Watch', 'Brand: Fossil, Gender: Men&#039;s, Model: BQ2219, Movement: Automatic + Quartz, Case Size: 48mm, Case Thickness: 12.50mm, Dial Color: Blue, Case Material: Stainless Steel', '2025-06-20 20:57:42'),
(54, 'Fossil Goodwin Chronograph Gold Dial Men&#039;s Watch | FS5414', 10800, 8900, '6855cb95e2ca85.36818766.webp', 6, 'Watch', 'Case Material: Stainless Steel, Case Shape: Round, Case Back: Transparent, Case Color: Silver, Band Material: Stainless Steel, Band Type: Bracelet, Band Color: Silver-tone, Band Width:', '2025-06-20 20:59:01'),
(55, 'Fossil Grant Chronograph Blue Dial Men’s Watch | FS5230', 16500, 12500, '6855cc02225f47.44646988.webp', 6, 'Watch', 'Material: Stainless Steel, Case Shape: Round, Case Back: Solid, Band Material: Stainless Steel, Band Type: Bracelet, Band Color: Blue , Band Width: 22mm, Clasp: Single Press Deploy', '2025-06-20 21:00:50'),
(56, 'Coachman Chronograph Black Strap Men’s Watch | CH2564', 6900, 5500, '6855cc67485159.00034104.jpeg', 6, 'Watch', 'Stainless Steel, Case Shape: Round, Case Back: Solid, Case Color: Silver, Band Material: Leather, Band Type: Strap, Band Color: Black, Band Width: 22mm, Clasp: Strap Buckle.', '2025-06-20 21:02:31'),
(57, 'Brox Multifunction Burgundy Dial Men&#039;s Watch | BQ2803', 10900, 8700, '6855cc99573bd5.12237595.webp', 6, 'Watch', 'The Fossil Brox Multifunction Burgundy Dial Men&#039;s Watch | BQ2803 combines bold style with practical functionality. Featuring a 50mm black stainless steel case', '2025-06-20 21:03:21'),
(58, 'Fossil Neutra Chronograph White Dial Men&#039;s Watch | FS6023', 14500, 11500, '6855ccca870cb6.00257591.webp', 6, 'Watch', 'Fossil Neutra Chronograph White Dial Men&#039;s Watch | FS6023. Inspired by the balanced symmetry of modern architecture, the Fossil Neutra Chronograph FS6023 offers a blend of form and function', '2025-06-20 21:04:10'),
(59, 'Commuter Automatic Brown Leather Black Dial Men&amp;#039;s Watch | ME3158', 17800, 15500, 'noisefit-halo-plus-1.webp', 6, 'Watch', 'Brand: Fossil, Series: Commuter, Gender: Men&amp;#039;s, Model: ME3158, Movement: Mechanical Automatic, Case Size: 42mm, Dial Colour: Black (Skeleton Centre), Case Material: Stainless Steel, Case Shape: Round', '2025-06-20 21:05:08'),
(60, 'Grant Sport Chronograph Men&amp;amp;amp;amp;amp;amp;#039;s Watch | FS5268', 13700, 10500, 'NoiseFit-Halo-AMOLED-Display-Smart-Watch.jpg', 6, 'Watch', 'Brand: Fossil, Series: Grant, Gender: Men&amp;amp;amp;amp;amp;amp;#039;s, Model: FS5268, Movement: Japan Quartz, Case Size: 44mm, Dial Color: Blue, Case Material: Stainless Steel, Case Shape: Round, Case Back: Solid, Case Color: Black', '2025-06-20 21:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `products_category`
--

CREATE TABLE `products_category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products_category`
--

INSERT INTO `products_category` (`id`, `name`, `create_at`) VALUES
(1, 'T-shirt', '2025-06-19 10:37:05'),
(2, 'Pants', '2025-06-19 10:37:16'),
(3, 'Jacket', '2025-06-19 10:37:33'),
(4, 'Blazer', '2025-06-19 10:37:38'),
(5, 'Hudi', '2025-06-19 10:37:48'),
(6, 'Watch', '2025-06-19 10:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Others') DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `address`, `picture`, `country`, `role`, `created_at`) VALUES
(1, 'Nurislam Imran', 'rose2025@gmail.com', '$2y$10$fqq9VsMgdL4kTyrB/ctFhOexTVJ5TmIMSlC3pfYmvzENCD/LKWswe', 'Male', '&lt;p&gt;&lt;strong&gt;Dhaka, Bangladesh&lt;/strong&gt;&lt;/p&gt;', 'assets/img/profile-pictures/6853c83134ca41006010619251109.jpg', 'Bangladesh', 'admin', '2025-06-17 17:22:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact-us_form`
--
ALTER TABLE `contact-us_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `products_category`
--
ALTER TABLE `products_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact-us_form`
--
ALTER TABLE `contact-us_form`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `products_category`
--
ALTER TABLE `products_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `products_category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
