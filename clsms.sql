USE [clsms]
GO
/****** Object:  Table [dbo].[Categorize_Serials]    Script Date: 16/10/2018 11:12:59 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Categorize_Serials](
	[DepartmentID] [varchar](10) NOT NULL,
	[SerialID] [int] NOT NULL,
	[CategoryID] [int] IDENTITY(1,1) NOT NULL,
 CONSTRAINT [PK_Categorize_Serials] PRIMARY KEY CLUSTERED 
(
	[CategoryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Delivery]    Script Date: 16/10/2018 11:13:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Delivery](
	[DeliveryID] [int] IDENTITY(1,1) NOT NULL,
	[SerialID] [int] NOT NULL,
	[DateofIssue] [date] NULL,
	[IssueNumber] [varchar](50) NULL,
	[VolumeNumber] [varchar](50) NULL,
	[Copies] [int] NOT NULL,
	[Receive_Date] [date] NULL,
 CONSTRAINT [PK_Delivery] PRIMARY KEY CLUSTERED 
(
	[DeliveryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Department]    Script Date: 16/10/2018 11:13:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Department](
	[DepartmentID] [varchar](10) NOT NULL,
	[DepartmentName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Department] PRIMARY KEY CLUSTERED 
(
	[DepartmentID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Distributor]    Script Date: 16/10/2018 11:13:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Distributor](
	[DistributorID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorName] [varchar](50) NOT NULL,
	[NameOfIncharge] [varchar](50) NOT NULL,
	[ContactNumber] [varchar](25) NOT NULL,
	[Email] [varchar](50) NULL,
	[Distributor_Type] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Distributor] PRIMARY KEY CLUSTERED 
(
	[DistributorID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Notification]    Script Date: 16/10/2018 11:13:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Notification](
	[NotificationID] [int] IDENTITY(1,1) NOT NULL,
	[SerialID] [int] NOT NULL,
	[NotificationType] [varchar](100) NOT NULL,
	[NotificationSeen] [varchar](50) NOT NULL,
	[Date_Receive_RedFlag] [date] NOT NULL,
 CONSTRAINT [PK_Notification] PRIMARY KEY CLUSTERED 
(
	[NotificationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReceiveSerial]    Script Date: 16/10/2018 11:13:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReceiveSerial](
	[ReceivedSerialID] [int] IDENTITY(1,1) NOT NULL,
	[DepartmentID] [varchar](10) NOT NULL,
	[SerialID] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[DateReceiveNotif_Give] [date] NOT NULL,
	[ControlNumber] [varchar](50) NULL,
	[RS_Seen] [varchar](7) NULL,
	[Staff_Comment] [varchar](100) NULL,
	[RS_Type] [varchar](20) NULL,
 CONSTRAINT [PK_ReceiveSerial] PRIMARY KEY CLUSTERED 
(
	[ReceivedSerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Serial]    Script Date: 16/10/2018 11:13:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Serial](
	[SerialID] [int] IDENTITY(1,1) NOT NULL,
	[TypeID] [int] NULL,
	[SerialName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Serial] PRIMARY KEY CLUSTERED 
(
	[SerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Subscription]    Script Date: 16/10/2018 11:13:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Subscription](
	[SubscriptionID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorID] [int] NOT NULL,
	[SerialID] [int] NOT NULL,
	[Orders] [int] NOT NULL,
	[Cost] [int] NOT NULL,
	[NumberOfItemReceived] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[Archive] [varchar](50) NULL,
	[IDD_Phase] [varchar](10) NULL,
	[InitialDeliveryDate] [date] NULL,
	[Subscription_Date] [date] NULL,
	[Subscription_End_Date] [date] NULL,
 CONSTRAINT [PK_Subscription] PRIMARY KEY CLUSTERED 
(
	[SubscriptionID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Type]    Script Date: 16/10/2018 11:13:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Type](
	[TypeID] [int] IDENTITY(1,1) NOT NULL,
	[TypeName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Type] PRIMARY KEY CLUSTERED 
(
	[TypeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[User]    Script Date: 16/10/2018 11:13:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[User](
	[UserID] [int] IDENTITY(1,1) NOT NULL,
	[UserName] [varchar](50) NOT NULL,
	[Password] [varchar](50) NOT NULL,
	[FirstName] [varchar](50) NOT NULL,
	[LastName] [varchar](50) NOT NULL,
	[Avatar] [varchar](50) NOT NULL,
	[Email] [varchar](50) NOT NULL,
	[Role] [varchar](25) NOT NULL,
	[DepartmentID] [varchar](10) NULL,
 CONSTRAINT [PK_User] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Categorize_Serials] ON 

INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SerialID], [CategoryID]) VALUES (N'SEAIDITE', 2, 2)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SerialID], [CategoryID]) VALUES (N'SHS', 5, 3)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SerialID], [CategoryID]) VALUES (N'ELEM', 5, 4)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SerialID], [CategoryID]) VALUES (N'SEAIDITE', 6, 5)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SerialID], [CategoryID]) VALUES (N'ELEM', 4, 22)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SerialID], [CategoryID]) VALUES (N'SEAIDITE', 4, 24)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SerialID], [CategoryID]) VALUES (N'ELEM', 2, 29)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SerialID], [CategoryID]) VALUES (N'SHS', 2, 32)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SerialID], [CategoryID]) VALUES (N'ELEM', 8, 35)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SerialID], [CategoryID]) VALUES (N'ELEM', 3, 38)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SerialID], [CategoryID]) VALUES (N'SHS', 3, 39)
SET IDENTITY_INSERT [dbo].[Categorize_Serials] OFF
SET IDENTITY_INSERT [dbo].[Delivery] ON 

INSERT [dbo].[Delivery] ([DeliveryID], [SerialID], [DateofIssue], [IssueNumber], [VolumeNumber], [Copies], [Receive_Date]) VALUES (68, 4, NULL, NULL, NULL, 6, CAST(N'2018-10-10' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [SerialID], [DateofIssue], [IssueNumber], [VolumeNumber], [Copies], [Receive_Date]) VALUES (86, 3, NULL, NULL, NULL, 3, CAST(N'2018-10-10' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [SerialID], [DateofIssue], [IssueNumber], [VolumeNumber], [Copies], [Receive_Date]) VALUES (89, 6, NULL, NULL, NULL, 3, CAST(N'2018-10-10' AS Date))
SET IDENTITY_INSERT [dbo].[Delivery] OFF
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'ELEM', N'Elementaryyy')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'HS', N'HighSchool')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'SEAIDITE', N'College')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'SHS', N'Senior High Schooll')
SET IDENTITY_INSERT [dbo].[Distributor] ON 

INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Distributor_Type]) VALUES (1, N'HAJIE', N'HajieNigger', N'12312315', N'hajienigger@gmail.com', N'PRE-PAID')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Distributor_Type]) VALUES (2, N'Emerald', N'Daniel', N'666666666', N'tabbu@gmail.com', N'POST-PAID')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Distributor_Type]) VALUES (3, N'FJM', N'Kyle', N'09061254785', N'era@gmail.com', N'POST-PAID')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Distributor_Type]) VALUES (4, N'UMX', N'Vince', N'096587414650', N'malano@gmail.com', N'POST-PAID')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Distributor_Type]) VALUES (5, N'Agdamag', N'Carl', N'095632541125', N'sagisi@yahoo.com', N'PRE-PAID')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email], [Distributor_Type]) VALUES (18, N'Try', N'Try2', N'0935556684', N'asd@gmail.com', N'PRE-PAID')
SET IDENTITY_INSERT [dbo].[Distributor] OFF
SET IDENTITY_INSERT [dbo].[Notification] ON 

INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date_Receive_RedFlag]) VALUES (38, 3, N'DeleyedDeliver_P1', N'NotSeen', CAST(N'2018-10-12' AS Date))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date_Receive_RedFlag]) VALUES (45, 6, N'DeleyedDeliver_P1', N'NotSeen', CAST(N'2018-10-12' AS Date))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date_Receive_RedFlag]) VALUES (52, 4, N'DeleyedDeliver_P1', N'NotSeen', CAST(N'2018-10-11' AS Date))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date_Receive_RedFlag]) VALUES (98, 2, N'DeleyedDeliver_P2', N'NotSeen', CAST(N'2018-10-16' AS Date))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date_Receive_RedFlag]) VALUES (102, 2, N'Received', N'NotSeen', CAST(N'2018-10-16' AS Date))
SET IDENTITY_INSERT [dbo].[Notification] OFF
SET IDENTITY_INSERT [dbo].[ReceiveSerial] ON 

INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [ControlNumber], [RS_Seen], [Staff_Comment], [RS_Type]) VALUES (2, N'SEAIDITE', 2, N'Received', CAST(N'2018-09-05' AS Date), N'2312312312', N'Seen', N'I''ve Received The Serial Thanks !!', N'Old')
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [ControlNumber], [RS_Seen], [Staff_Comment], [RS_Type]) VALUES (3, N'SHS', 5, N'NotReceived', CAST(N'2018-09-05' AS Date), NULL, N'Seen', N'You''ve Send Me The Wrong Serial Ma''am Please Verify This Serial Name Bla Bla Bla', NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [ControlNumber], [RS_Seen], [Staff_Comment], [RS_Type]) VALUES (4, N'ELEM', 5, N'Received', CAST(N'2018-09-05' AS Date), N'666', N'Seen', N' TY I GOT THE STUFF DONT TELL THE COPS!!!', N'Old')
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [ControlNumber], [RS_Seen], [Staff_Comment], [RS_Type]) VALUES (37, N'ELEM', 2, N'Received', CAST(N'2018-10-16' AS Date), N'123', N'Seen', N' asd', NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [ControlNumber], [RS_Seen], [Staff_Comment], [RS_Type]) VALUES (38, N'HS', 2, N'NotReceived', CAST(N'2018-10-16' AS Date), NULL, N'NotSeen', NULL, NULL)
SET IDENTITY_INSERT [dbo].[ReceiveSerial] OFF
SET IDENTITY_INSERT [dbo].[Serial] ON 

INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (2, 1, N'DUMMY')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (3, 2, N'Catholic Historical Review')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (4, 2, N'Disney Princess')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (5, 1, N'Journal of Abnormal Psychology (APA)')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (6, 2, N'Adventure Box')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (8, 1, N'Adventure Box2')
SET IDENTITY_INSERT [dbo].[Serial] OFF
SET IDENTITY_INSERT [dbo].[Subscription] ON 

INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date]) VALUES (144, 4, 3, 6, 666, 6, N'Refunded', N'Archived', NULL, NULL, NULL, NULL)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date]) VALUES (145, 3, 5, 6, 600, 6, N'Finished', N'Archived', NULL, NULL, NULL, NULL)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date]) VALUES (148, 18, 4, 23, 233, 0, N'OnGoing', NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date]) VALUES (152, 18, 3, 3, 3, 0, N'OnGoing', NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date]) VALUES (154, 1, 2, 6, 6, 0, N'Cancelled', NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date]) VALUES (170, 4, 2, 10, 666, 0, N'OnGoing', NULL, N'Phase2', CAST(N'2018-09-16' AS Date), CAST(N'2018-10-16' AS Date), CAST(N'2018-10-31' AS Date))
SET IDENTITY_INSERT [dbo].[Subscription] OFF
SET IDENTITY_INSERT [dbo].[Type] ON 

INSERT [dbo].[Type] ([TypeID], [TypeName]) VALUES (1, N'Journal')
INSERT [dbo].[Type] ([TypeID], [TypeName]) VALUES (2, N'Magazine')
SET IDENTITY_INSERT [dbo].[Type] OFF
SET IDENTITY_INSERT [dbo].[User] ON 

INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID]) VALUES (179, N'NewAcc', N'7815696ecbf1c96e6894b779456d330e', N'New', N'Account', N'christaa.jpg', N'NA@gmail.com', N'Staff', N'ELEM')
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID]) VALUES (182, N'Akumao', N'21232f297a57a5a743894a0e4a801fc3', N'Aku', N'Mao', N'609282.jpg', N'akumao@gmail.com', N'Admin', N'ELEM')
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID]) VALUES (183, N'hajie', N'21232f297a57a5a743894a0e4a801fc3', N'hajie', N'nub', N'trump.jpg', N'hajie@gmail.com', N'Admin', N'ELEM')
SET IDENTITY_INSERT [dbo].[User] OFF
ALTER TABLE [dbo].[Categorize_Serials]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Serials_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Serials] CHECK CONSTRAINT [FK_Categorize_Serials_Department]
GO
ALTER TABLE [dbo].[Categorize_Serials]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Serials_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Serials] CHECK CONSTRAINT [FK_Categorize_Serials_Serial]
GO
ALTER TABLE [dbo].[Delivery]  WITH CHECK ADD  CONSTRAINT [FK_Delivery_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Delivery] CHECK CONSTRAINT [FK_Delivery_Serial]
GO
ALTER TABLE [dbo].[Notification]  WITH CHECK ADD  CONSTRAINT [FK_Notification_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Notification] CHECK CONSTRAINT [FK_Notification_Serial]
GO
ALTER TABLE [dbo].[ReceiveSerial]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial] CHECK CONSTRAINT [FK_ReceiveSerial_Department]
GO
ALTER TABLE [dbo].[ReceiveSerial]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ReceiveSerial] CHECK CONSTRAINT [FK_ReceiveSerial_Serial]
GO
ALTER TABLE [dbo].[Serial]  WITH CHECK ADD  CONSTRAINT [FK_Serial_Type] FOREIGN KEY([TypeID])
REFERENCES [dbo].[Type] ([TypeID])
ON UPDATE CASCADE
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[Serial] CHECK CONSTRAINT [FK_Serial_Type]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Distributor] FOREIGN KEY([DistributorID])
REFERENCES [dbo].[Distributor] ([DistributorID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Distributor]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Serial]
GO
ALTER TABLE [dbo].[User]  WITH CHECK ADD  CONSTRAINT [FK_User_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE SET NULL
GO
ALTER TABLE [dbo].[User] CHECK CONSTRAINT [FK_User_Department]
GO
