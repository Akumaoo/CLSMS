USE [clsms]
GO
/****** Object:  Table [dbo].[Categorize_Dept]    Script Date: 01/10/2018 2:17:54 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Categorize_Dept](
	[SubscriptionID] [int] NOT NULL,
	[DepartmentID] [varchar](10) NOT NULL,
	[numberbooks] [int] NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Delivery]    Script Date: 01/10/2018 2:17:54 AM ******/
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
	[PackageID] [int] NOT NULL,
 CONSTRAINT [PK_Delivery] PRIMARY KEY CLUSTERED 
(
	[DeliveryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Department]    Script Date: 01/10/2018 2:17:55 AM ******/
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
/****** Object:  Table [dbo].[Distributor]    Script Date: 01/10/2018 2:17:55 AM ******/
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
/****** Object:  Table [dbo].[Notification]    Script Date: 01/10/2018 2:17:55 AM ******/
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
/****** Object:  Table [dbo].[Package_Delivery]    Script Date: 01/10/2018 2:17:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Package_Delivery](
	[PackageID] [int] IDENTITY(1,1) NOT NULL,
	[PackageName] [varchar](50) NOT NULL,
	[ReceiveDate] [date] NULL,
	[ExpectedReceiveDate] [date] NOT NULL,
	[Package_Phase] [varchar](20) NOT NULL,
 CONSTRAINT [PK_Package_Delivery] PRIMARY KEY CLUSTERED 
(
	[PackageID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReceiveSerial]    Script Date: 01/10/2018 2:17:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReceiveSerial](
	[ReceivedSerialID] [int] IDENTITY(1,1) NOT NULL,
	[DepartmentID] [varchar](10) NOT NULL,
	[SerialID] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[DateReceiveNotif_Give] [datetime] NOT NULL,
	[ControlNumber] [varchar](50) NULL,
 CONSTRAINT [PK_ReceiveSerial] PRIMARY KEY CLUSTERED 
(
	[ReceivedSerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Serial]    Script Date: 01/10/2018 2:17:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Serial](
	[SerialID] [int] IDENTITY(1,1) NOT NULL,
	[TypeID] [int] NOT NULL,
	[SerialName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Serial] PRIMARY KEY CLUSTERED 
(
	[SerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Subscription]    Script Date: 01/10/2018 2:17:55 AM ******/
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
 CONSTRAINT [PK_Subscription] PRIMARY KEY CLUSTERED 
(
	[SubscriptionID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Type]    Script Date: 01/10/2018 2:17:55 AM ******/
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
/****** Object:  Table [dbo].[User]    Script Date: 01/10/2018 2:17:55 AM ******/
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
	[Avatar] [varchar](100) NOT NULL,
	[Email] [varchar](50) NOT NULL,
	[Role] [varchar](25) NOT NULL,
	[DepartmentID] [varchar](10) NULL,
 CONSTRAINT [PK_User] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Delivery] ON 

INSERT [dbo].[Delivery] ([DeliveryID], [SerialID], [DateofIssue], [IssueNumber], [VolumeNumber], [PackageID]) VALUES (6, 5, CAST(N'2018-06-12' AS Date), N'5', N'10', 1)
INSERT [dbo].[Delivery] ([DeliveryID], [SerialID], [DateofIssue], [IssueNumber], [VolumeNumber], [PackageID]) VALUES (7, 3, NULL, N'10', N'3', 2)
INSERT [dbo].[Delivery] ([DeliveryID], [SerialID], [DateofIssue], [IssueNumber], [VolumeNumber], [PackageID]) VALUES (9, 2, CAST(N'2018-06-12' AS Date), N'', N'', 1)
SET IDENTITY_INSERT [dbo].[Delivery] OFF
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'ELEM', N'Elementary')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'HS', N'HighSchool')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'SEAIDITE', N'College')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName]) VALUES (N'SHS', N'Senior High School')
SET IDENTITY_INSERT [dbo].[Distributor] ON 

INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (1, N'HAJIE', N'HAJIENIGGER', N'0215120', N'hajienigger@gmail.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (2, N'Emerald', N'Daniel', N'09979873654', N'tabbu@gmail.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (3, N'FJM', N'Kyle', N'09061254785', N'era@gmail.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (4, N'UMX', N'Vince', N'096587414650', N'malano@gmail.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (5, N'Agdamag', N'Carl', N'095632541125', N'sagisi@yahoo.com')
SET IDENTITY_INSERT [dbo].[Distributor] OFF
SET IDENTITY_INSERT [dbo].[Notification] ON 

INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date_Receive_RedFlag]) VALUES (2, 2, N'Received', N'NotSeen', CAST(N'2018-09-05' AS Date))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date_Receive_RedFlag]) VALUES (7, 5, N'Received', N'NotSeen', CAST(N'2018-09-05' AS Date))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date_Receive_RedFlag]) VALUES (8, 5, N'Received', N'Seen', CAST(N'2018-09-05' AS Date))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date_Receive_RedFlag]) VALUES (9, 5, N'DeleyedDeliver', N'NotSeen', CAST(N'2018-09-05' AS Date))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date_Receive_RedFlag]) VALUES (11, 2, N'DeleyedDeliver', N'NotSeen', CAST(N'2018-09-05' AS Date))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date_Receive_RedFlag]) VALUES (16, 3, N'DeleyedDeliver', N'NotSeen', CAST(N'2018-09-30' AS Date))
SET IDENTITY_INSERT [dbo].[Notification] OFF
SET IDENTITY_INSERT [dbo].[Package_Delivery] ON 

INSERT [dbo].[Package_Delivery] ([PackageID], [PackageName], [ReceiveDate], [ExpectedReceiveDate], [Package_Phase]) VALUES (1, N'Initial Delivery', NULL, CAST(N'2019-03-01' AS Date), N'Phase2')
INSERT [dbo].[Package_Delivery] ([PackageID], [PackageName], [ReceiveDate], [ExpectedReceiveDate], [Package_Phase]) VALUES (2, N'2nd Delivery', NULL, CAST(N'2018-08-29' AS Date), N'Phase2')
SET IDENTITY_INSERT [dbo].[Package_Delivery] OFF
SET IDENTITY_INSERT [dbo].[ReceiveSerial] ON 

INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [ControlNumber]) VALUES (1, N'HS', 2, N'NotReceived', CAST(N'2018-09-05T19:19:00.000' AS DateTime), NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [ControlNumber]) VALUES (2, N'SEAIDITE', 2, N'Received', CAST(N'2018-09-05T19:19:00.000' AS DateTime), NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [ControlNumber]) VALUES (3, N'SHS', 5, N'Received', CAST(N'2018-09-05T19:19:00.000' AS DateTime), NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [ControlNumber]) VALUES (4, N'ELEM', 5, N'Received', CAST(N'2018-09-05T19:19:00.000' AS DateTime), NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [DateReceiveNotif_Give], [ControlNumber]) VALUES (5, N'SEAIDITE', 6, N'NotReceived', CAST(N'2018-09-05T19:19:00.000' AS DateTime), NULL)
SET IDENTITY_INSERT [dbo].[ReceiveSerial] OFF
SET IDENTITY_INSERT [dbo].[Serial] ON 

INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (2, 1, N'DUMMY')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (3, 2, N'Catholic Historical Review')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (4, 2, N'Disney Princess')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (5, 1, N'Journal of Abnormal Psychology (APA)')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (6, 2, N'Adventure Box')
SET IDENTITY_INSERT [dbo].[Serial] OFF
SET IDENTITY_INSERT [dbo].[Subscription] ON 

INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status]) VALUES (5, 4, 3, 3, 300, 3, N'Finished')
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status]) VALUES (21, 3, 5, 6, 600, 0, N'Refunded')
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status]) VALUES (22, 3, 2, 10, 1000, 0, N'Refunded')
SET IDENTITY_INSERT [dbo].[Subscription] OFF
SET IDENTITY_INSERT [dbo].[Type] ON 

INSERT [dbo].[Type] ([TypeID], [TypeName]) VALUES (1, N'Journal')
INSERT [dbo].[Type] ([TypeID], [TypeName]) VALUES (2, N'Magazine')
SET IDENTITY_INSERT [dbo].[Type] OFF
SET IDENTITY_INSERT [dbo].[User] ON 

INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID]) VALUES (1, N'akumao', N'admin', N'mark', N'tabbu', N'asd', N'asd', N'asd', NULL)
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role], [DepartmentID]) VALUES (2, N'hajie', N'admin2', N'hajie', N'nub', N'asd', N'asd', N'asd', NULL)
SET IDENTITY_INSERT [dbo].[User] OFF
ALTER TABLE [dbo].[Categorize_Dept]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Dept_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Dept] CHECK CONSTRAINT [FK_Categorize_Dept_Department]
GO
ALTER TABLE [dbo].[Categorize_Dept]  WITH CHECK ADD  CONSTRAINT [FK_Categorize_Dept_Subscription] FOREIGN KEY([SubscriptionID])
REFERENCES [dbo].[Subscription] ([SubscriptionID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Categorize_Dept] CHECK CONSTRAINT [FK_Categorize_Dept_Subscription]
GO
ALTER TABLE [dbo].[Delivery]  WITH CHECK ADD  CONSTRAINT [FK_Delivery_Package_Delivery] FOREIGN KEY([PackageID])
REFERENCES [dbo].[Package_Delivery] ([PackageID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Delivery] CHECK CONSTRAINT [FK_Delivery_Package_Delivery]
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
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Serial] CHECK CONSTRAINT [FK_Serial_Type]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Distributor] FOREIGN KEY([DistributorID])
REFERENCES [dbo].[Distributor] ([DistributorID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Distributor]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Serial]
GO
ALTER TABLE [dbo].[User]  WITH CHECK ADD  CONSTRAINT [FK_User_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[User] CHECK CONSTRAINT [FK_User_Department]
GO
