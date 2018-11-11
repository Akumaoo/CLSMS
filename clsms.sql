USE [clsms]
GO
/****** Object:  Table [dbo].[Categorize_Serials]    Script Date: 11/11/2018 11:38:44 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Categorize_Serials](
	[DepartmentID] [varchar](30) NOT NULL,
	[SubscriptionID] [int] NOT NULL,
	[CategoryID] [int] IDENTITY(1,1) NOT NULL,
	[NumberOfItemReceived] [int] NOT NULL,
	[Usage_Stat] [int] NOT NULL,
 CONSTRAINT [PK_Categorize_Serials] PRIMARY KEY CLUSTERED 
(
	[CategoryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Delivery]    Script Date: 11/11/2018 11:38:44 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Delivery](
	[DeliveryID] [int] IDENTITY(1,1) NOT NULL,
	[Receive_Date] [date] NULL,
 CONSTRAINT [PK_Delivery] PRIMARY KEY CLUSTERED 
(
	[DeliveryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Delivery_Subs]    Script Date: 11/11/2018 11:38:44 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Delivery_Subs](
	[DS_ID] [int] IDENTITY(1,1) NOT NULL,
	[DeliveryID] [int] NOT NULL,
	[SubscriptionID] [int] NOT NULL,
	[DateofIssue] [date] NULL,
	[IssueNumber] [varchar](50) NULL,
	[VolumeNumber] [varchar](50) NULL,
 CONSTRAINT [PK_Delivery_Subs] PRIMARY KEY CLUSTERED 
(
	[DS_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Department]    Script Date: 11/11/2018 11:38:44 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Department](
	[DepartmentID] [varchar](30) NOT NULL,
	[DepartmentName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Department] PRIMARY KEY CLUSTERED 
(
	[DepartmentID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Distributor]    Script Date: 11/11/2018 11:38:44 PM ******/
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
 CONSTRAINT [PK_Distributor] PRIMARY KEY CLUSTERED 
(
	[DistributorID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReceiveSerial]    Script Date: 11/11/2018 11:38:44 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReceiveSerial](
	[ReceivedSerialID] [int] IDENTITY(1,1) NOT NULL,
	[DepartmentID] [varchar](30) NOT NULL,
	[SerialID] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[DateReceiveNotif_Give] [date] NOT NULL,
	[DateReceiveNotif_Receive] [date] NULL,
	[ControlNumber] [varchar](50) NULL,
	[Admin_Seen] [varchar](7) NULL,
	[Staff_Seen] [varchar](7) NULL,
	[Staff_Comment] [varchar](100) NULL,
 CONSTRAINT [PK_ReceiveSerial] PRIMARY KEY CLUSTERED 
(
	[ReceivedSerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Serial]    Script Date: 11/11/2018 11:38:44 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Serial](
	[SerialID] [int] IDENTITY(1,1) NOT NULL,
	[TypeName] [varchar](30) NULL,
	[SerialName] [varchar](50) NOT NULL,
	[Origin] [varchar](20) NULL,
 CONSTRAINT [PK_Serial] PRIMARY KEY CLUSTERED 
(
	[SerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Subscription]    Script Date: 11/11/2018 11:38:44 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Subscription](
	[SubscriptionID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorID] [int] NOT NULL,
	[SerialID] [int] NOT NULL,
	[Cost] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[Archive] [varchar](50) NULL,
	[IDD_Phase] [varchar](10) NULL,
	[InitialDeliveryDate] [date] NULL,
	[Subscription_Date] [date] NULL,
	[Subscription_End_Date] [date] NULL,
	[Frequency] [int] NOT NULL,
 CONSTRAINT [PK_Subscription] PRIMARY KEY CLUSTERED 
(
	[SubscriptionID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[User]    Script Date: 11/11/2018 11:38:45 PM ******/
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
	[DepartmentID] [varchar](30) NULL,
 CONSTRAINT [PK_User] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Categorize_Serials] ON 

INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'HS', 1229, 120, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'ELEM', 1242, 158, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'HS', 1242, 159, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'JHS', 1242, 160, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'ELEM', 1243, 1170, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'HS', 1243, 1171, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'JHS', 1243, 1172, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'ELEM', 152, 1177, 0, 0)
INSERT [dbo].[Categorize_Serials] ([DepartmentID], [SubscriptionID], [CategoryID], [NumberOfItemReceived], [Usage_Stat]) VALUES (N'HS', 152, 1178, 0, 0)
SET IDENTITY_INSERT [dbo].[Categorize_Serials] OFF
SET IDENTITY_INSERT [dbo].[Delivery] ON 

INSERT [dbo].[Delivery] ([DeliveryID], [Receive_Date]) VALUES (143, CAST(N'2018-11-08' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [Receive_Date]) VALUES (1143, CAST(N'2018-11-11' AS Date))
SET IDENTITY_INSERT [dbo].[Delivery] OFF
SET IDENTITY_INSERT [dbo].[Delivery_Subs] ON 

INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber]) VALUES (30, 143, 1243, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber]) VALUES (31, 143, 1243, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber]) VALUES (32, 143, 1242, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber]) VALUES (33, 143, 1229, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber]) VALUES (34, 143, 1242, NULL, NULL, NULL)
INSERT [dbo].[Delivery_Subs] ([DS_ID], [DeliveryID], [SubscriptionID], [DateofIssue], [IssueNumber], [VolumeNumber]) VALUES (1030, 1143, 152, NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[Delivery_Subs] OFF
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'ELEM', N'Elementaryyy')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'HS', N'HighSchool')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'JHS', N'Junior High School')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'new', N'new')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'new2', N'new2')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'SEAIDITE', N'College1')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'SHS', N'Senior High Schoolld')
SET IDENTITY_INSERT [dbo].[Distributor] ON 

INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (1, N'HAJIE', N'HajieNigger', N'12312315', N'hajienigger@gmail.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (2, N'Emerald', N'Daniel', N'666666666', N'tabbu@gmail.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (3, N'FJM', N'Kyle', N'09061254785', N'era@gmail.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (4, N'UMX', N'Vince', N'096587414650', N'malano@gmail.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (5, N'Agdamag', N'Carl', N'095632541125', N'sagisi@yahoo.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (18, N'Try', N'Try2', N'0935556684', N'asd@gmail.com')
SET IDENTITY_INSERT [dbo].[Distributor] OFF
SET IDENTITY_INSERT [dbo].[ReceiveSerial] ON 

INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment]) VALUES (2, N'SEAIDITE', 2, N'Received', CAST(N'2018-09-05' AS Date), CAST(N'2018-11-08' AS Date), N'2312312312', NULL, N'Seen', N'I''ve Received The Serial Thanks !!')
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment]) VALUES (3, N'SHS', 5, N'NotReceived', CAST(N'2018-09-05' AS Date), NULL, NULL, NULL, NULL, N'You''ve Send Me The Wrong Serial Ma''am Please Verify This Serial Name Bla Bla Bla')
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment]) VALUES (4, N'ELEM', 5, N'Received', CAST(N'2018-09-05' AS Date), CAST(N'2018-11-08' AS Date), N'666', NULL, NULL, N' TY I GOT THE STUFF DONT TELL THE COPS!!!')
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment]) VALUES (37, N'ELEM', 2, N'Received', CAST(N'2018-10-16' AS Date), CAST(N'2018-11-08' AS Date), N'123', NULL, N'Seen', N' asd')
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment]) VALUES (38, N'HS', 2, N'NotReceived', CAST(N'2018-10-16' AS Date), NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment]) VALUES (66, N'ELEM', 25, N'Received', CAST(N'2018-11-08' AS Date), CAST(N'2018-11-08' AS Date), N'123', NULL, N'Seen', N'asdasdasdas')
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment]) VALUES (67, N'HS', 25, N'Received', CAST(N'2018-11-08' AS Date), CAST(N'2018-11-08' AS Date), N'123', NULL, N'Seen', N'asdasdas')
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment]) VALUES (68, N'ELEM', 6, N'Received', CAST(N'2018-11-08' AS Date), CAST(N'2018-11-08' AS Date), N'123', NULL, N'Seen', N'sdadasdas')
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment]) VALUES (69, N'HS', 4, N'NotReceived', CAST(N'2018-11-08' AS Date), NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment]) VALUES (70, N'HS', 6, N'NotReceived', CAST(N'2018-11-08' AS Date), NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [DateReceiveNotif_Receive], [ControlNumber], [Admin_Seen], [Staff_Seen], [Staff_Comment]) VALUES (1066, N'ELEM', 3, N'NotReceived', CAST(N'2018-11-11' AS Date), NULL, NULL, NULL, N'Seen', NULL)
SET IDENTITY_INSERT [dbo].[ReceiveSerial] OFF
SET IDENTITY_INSERT [dbo].[Serial] ON 

INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin]) VALUES (2, N'Journal', N'DUMMY', N'Local')
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin]) VALUES (3, N'Magazine', N'Catholic Historical Review', N'International')
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin]) VALUES (4, N'Magazine', N'Disney Princess', N'Local')
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin]) VALUES (5, N'Journal', N'Journal of Abnormal Psychology (APA)', N'International')
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin]) VALUES (6, N'Magazine', N'Adventure Box', N'Local')
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin]) VALUES (8, N'Journal', N'Adventure Box2', N'International')
INSERT [dbo].[Serial] ([SerialID], [TypeName], [SerialName], [Origin]) VALUES (25, N'Magazine', N'new', N'International')
SET IDENTITY_INSERT [dbo].[Serial] OFF
SET IDENTITY_INSERT [dbo].[Subscription] ON 

INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency]) VALUES (144, 4, 3, 666, N'Refunded', NULL, NULL, NULL, NULL, NULL, 20)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency]) VALUES (145, 3, 5, 600, N'Finished', NULL, NULL, NULL, NULL, NULL, 20)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency]) VALUES (152, 18, 3, 3, N'OnGoing', NULL, N'Complete', CAST(N'2017-02-23' AS Date), CAST(N'2018-10-23' AS Date), CAST(N'2018-10-24' AS Date), 20)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency]) VALUES (154, 1, 2, 6, N'Cancelled', NULL, NULL, NULL, NULL, NULL, 20)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency]) VALUES (1211, 4, 2, 5, N'Finished', N'Archived', N'Complete', CAST(N'2019-02-23' AS Date), CAST(N'2013-10-23' AS Date), CAST(N'2018-10-31' AS Date), 20)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency]) VALUES (1229, 4, 4, 6, N'OnGoing', NULL, N'Complete', CAST(N'2019-03-06' AS Date), CAST(N'2018-11-06' AS Date), CAST(N'2018-10-10' AS Date), 6)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency]) VALUES (1242, 4, 6, 6, N'OnGoing', NULL, N'Complete', CAST(N'2019-03-07' AS Date), CAST(N'2018-11-07' AS Date), CAST(N'2018-11-30' AS Date), 6)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency]) VALUES (1243, 4, 25, 6, N'OnGoing', NULL, N'Complete', CAST(N'2019-05-07' AS Date), CAST(N'2018-11-07' AS Date), CAST(N'2018-11-07' AS Date), 6)
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Cost], [Status], [Archive], [IDD_Phase], [InitialDeliveryDate], [Subscription_Date], [Subscription_End_Date], [Frequency]) VALUES (2244, 18, 2, 3, N'OnGoing', NULL, N'Phase2', CAST(N'2017-01-01' AS Date), CAST(N'2018-10-23' AS Date), CAST(N'2018-10-24' AS Date), 20)
SET IDENTITY_INSERT [dbo].[Subscription] OFF
SET IDENTITY_INSERT [dbo].[User] ON 

INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID]) VALUES (179, N'NewAcc', N'7815696ecbf1c96e6894b779456d330e', N'New', N'Account', N'christaa.jpg', N'NA@gmail.com', N'Staff', N'ELEM')
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID]) VALUES (182, N'Akumao', N'21232f297a57a5a743894a0e4a801fc3', N'Aku', N'Mao', N'609282.jpg', N'akumao@gmail.com', N'Admin', NULL)
SET IDENTITY_INSERT [dbo].[User] OFF
ALTER TABLE [dbo].[Categorize_Serials]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Serials_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Serials] CHECK CONSTRAINT [FK_Categorize_Serials_Department]
GO
ALTER TABLE [dbo].[Categorize_Serials]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Serials_Subscription] FOREIGN KEY([SubscriptionID])
REFERENCES [dbo].[Subscription] ([SubscriptionID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Serials] CHECK CONSTRAINT [FK_Categorize_Serials_Subscription]
GO
ALTER TABLE [dbo].[Delivery_Subs]  WITH CHECK ADD  CONSTRAINT [FK_Delivery_Subs_Delivery] FOREIGN KEY([DeliveryID])
REFERENCES [dbo].[Delivery] ([DeliveryID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Delivery_Subs] CHECK CONSTRAINT [FK_Delivery_Subs_Delivery]
GO
ALTER TABLE [dbo].[Delivery_Subs]  WITH CHECK ADD  CONSTRAINT [FK_Delivery_Subs_Subscription] FOREIGN KEY([SubscriptionID])
REFERENCES [dbo].[Subscription] ([SubscriptionID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Delivery_Subs] CHECK CONSTRAINT [FK_Delivery_Subs_Subscription]
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
